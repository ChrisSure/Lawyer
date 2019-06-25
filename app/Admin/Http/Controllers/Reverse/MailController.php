<?php

namespace App\Admin\Http\Controllers\Reverse;

use App\Admin\Entity\Mail;
use App\Admin\UseCases\Reverse\MailService;
use App\Admin\Http\Requests\Reverse\MailCreateRequest;
use App\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MailController extends Controller
{

    /**
     * @var MailService
     */
    private $service;

    public function __construct(MailService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        $mails = Mail::orderByDesc('id')->paginate(20);
        return view('admin.reverse.mail.index', compact('mails'));
    }

    public function create()
    {
        return view('admin.reverse.mail.create');
    }

    public function store(MailCreateRequest $request)
    {
        Mail::new(
            $request['text']
        );
        $this->service->sendMail($request['text']);
        return redirect()->route('admin.mail.index')->with('success', 'Ви успішно додали розсилку.');
    }

    public function destroy(Mail $mail)
    {
        $mail->delete();
        return redirect()->route('admin.mail.index')->with('success', 'Ви успішно видалили розсилку.');
    }

}