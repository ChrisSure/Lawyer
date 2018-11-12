<?php

namespace App\Site\Http\Controllers\State;

use App\Site\Entity\State;
use App\Site\Http\Controllers\State\Interfaces\StateInterface;
use App\Site\Http\Requests\State\N1Request;
use App\Site\UseCases\State\StateService;
use Illuminate\Http\Request;
use App\Common\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class N1Controller extends Controller implements StateInterface
{

    private $sum = 20;

    /**
     * @var StateService
     */
    private $service;

    public function __construct(StateService $service)
    {

        $this->service = $service;
    }

    public function index()
    {
        return view('site.state.n1.index');
    }

    public function create(N1Request $request)
    {
        $objWriter = $this->buildingWord($request);
        $filename = $this->getName();
        $this->saveFileDoc($objWriter, $filename);
        $state = $this->saveDbDoc($filename);
        $this->saveSession($state->id);

        return redirect()->route('state.pay');
    }

    public function buildingWord(N1Request $request): \PhpOffice\PhpWord\Writer\HTML
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText(
            $request->circum
        );
        return \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    }

    public function getName(): string
    {
        return str_random(10);
    }

    public function saveFileDoc(\PhpOffice\PhpWord\Writer\HTML $objWriter, string $filename): void
    {
        $objWriter->save(storage_path('word/' . $filename . '.docx'));
    }

    public function saveDbDoc(string $filename): State
    {
        return $this->service->save($filename . '.docx', $this->sum);
    }

    public function saveSession(int $state_id): void
    {
        session(['state_id' => $state_id]);
        session(['state_sum' => $this->sum]);
    }









}
