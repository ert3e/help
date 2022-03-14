<?php

namespace App\Modules\Site\Feedbacks\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Site\Employees\Models\Employee;
use App\Modules\Site\Feedbacks\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends SiteController
{

    public function default(Request $request)
    {

        $validator = Validator::make($request->all(), [
            //'name'           => 'required',
            //'telephone'      => 'required',
            'email'          => 'required|email',
            'description'    => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'errors' => $validator->errors()->messages()
            ]);
        }

        $data = $request->all();

        $fb = Feedback::create($data);

        $data['date'] = date('d.m.Y H:i');

        if ($fb) {

            /*Mail::send('templates.mails.feedback', $data, function ($message) use ($fb, $request) {
                $message->from($this->emailSender, setting('main.title'))
                    ->to(setting('contacts.email_alerts'))
                    ->subject($this->siteName.': обратная связь #' . $fb->id);
            });*/

            return response()->json([
                'success' => 'Запрос успешно отправлен!'
            ]);

        }

        return redirect()->back();
    }

    public function help(Request $request)
    {

        $validator = Validator::make($request->all(), [
            //'name'           => 'required',
            'telephone'      => 'required',
            //'email'          => 'email',
            'description'    => 'required',
        ]);

        if ($validator->fails())
        {

            return response()->json([
                'errors' => $validator->errors()->messages()
            ]);
        }

        $data = $request->all();
        $data['type'] = Feedback::FEEDBACK_HELP;

        $fb = Feedback::create($data);

        $data['date'] = date('d.m.Y H:i');

        if ($fb) {

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $fb->uploadFile($file);
            }

            /*Mail::send('templates.mails.feedback', $data, function ($message) use ($fb, $request) {
                $message->from($this->emailSender, setting('main.title'))
                    ->to(setting('contacts.email_alerts'))
                    ->subject($this->siteName.': обратная связь #' . $fb->id);
            });*/

            return response()->json([
                'success' => 'Запрос успешно отправлен!'
            ]);

        }

        return redirect()->back();
    }

    public function volunteer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            //'name'           => 'required',
            'telephone'      => 'required',
            //'email'          => 'email',
            //'description'    => 'required',
        ]);

        if ($validator->fails())
        {

            return response()->json([
                'errors' => $validator->errors()->messages()
            ]);
        }

        $data = $request->all();
        $data['type'] = Feedback::FEEDBACK_VOLUNTEER;

        $fb = Feedback::create($data);

        $data['date'] = date('d.m.Y H:i');

        if ($fb) {

            /*Mail::send('templates.mails.feedback', $data, function ($message) use ($fb, $request) {
                $message->from($this->emailSender, setting('main.title'))
                    ->to(setting('contacts.email_alerts'))
                    ->subject($this->siteName.': обратная связь #' . $fb->id);
            });*/

            return response()->json([
                'success' => 'Запрос успешно отправлен!'
            ]);

        }

        return redirect()->back();
    }

}
