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
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{

    public function sendAllEmails()
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

                Mail::to($user->email)->send(new DemoMail($mailData, App::getLocale()));

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
        return redirect()->back()->with('success', __('Emails have been sent successfully.'));
    }

}
