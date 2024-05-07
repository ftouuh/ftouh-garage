<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Models\User;
use App\Models\Repair;
use App\Models\SentEmail;
use Carbon\Carbon;

class MailController extends Controller
{
    public function showMails()
    {
        $emails = SentEmail::with('user')->get();
        return
            view('admin.management.mail-data', ['emails' => $emails]);
    }
    public function index(Request $request)
    {

        $repairId = $request->query('repair_id');

        $user = User::whereHas('repairs', function ($query) use ($repairId) {
            $query->where('id', $repairId)
                ->where('status', 'completed');
        })->first();

        if ($user) {
            $repair = Repair::find($repairId);

            $mailData = [
                'title' => 'Repair Completed Notification',
                'description' => $repair->description,
                'dateCompleted' => Carbon::parse($repair->endDate)->format('Y-m-d'),
            ];

            Mail::to($user->email)->send(new DemoMail($mailData));

            $sentEmail = new SentEmail([
                'recipient' => $user->email,
                'subject' => $mailData['title'],
                'body' => $mailData['description'],
                'user_id' => $user->id,
                'sent_at' => now(),
            ]);
            $sentEmail->save();
            return redirect()->back()->with('success', 'Email has been sent successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found or repair is not completed.');
        }
    }

    public function sendAll()
    {
        $users = User::with('repairs')->whereHas('repairs', function ($query) {
            $query->where('status', 'completed');
        })->get();

        foreach ($users as $user) {
            foreach ($user->repairs as $repair) {
                $mailData = [
                    'title' => 'Repair Completed Notification',
                    'description' => $repair->description,
                    'dateCompleted' => Carbon::parse($repair->endDate)->format('Y-m-d'),
                ];

                Mail::to($user->email)->send(new DemoMail($mailData));

                $sentEmail = new SentEmail([
                    'recipient' => $user->email,
                    'subject' => $mailData['title'],
                    'body' => $mailData['description'],
                    'user_id' => $user->id,
                    'sent_at' => now(),
                ]);
                $sentEmail->save();
            }
        }
        return redirect()->back()->with('success', 'Emails have been sent successfully.');
    }


    public function sendEmail(Request $request)
    {
        $mailData = [
            'title' => $request->input('title'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // Check if it's an email for completed repair
        if ($mailData['title'] === 'Repair Completed Notification') {
            
        } else {
            // Process sending other types of emails
            Mail::to($mailData['title'])->send(new DemoMail($mailData));
        }

        return response()->json(['message' => 'Email sent successfully']);
    }
}
