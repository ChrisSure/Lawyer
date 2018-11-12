<?php

namespace App\Site\Http\Controllers\State\Interfaces;

use App\Site\Entity\State;
use App\Site\Http\Requests\State\N1Request;

/**
 * Інтерфейс для формування документа
 *
 * Interface StateInterface
 * @package App\Site\Http\Controllers\State\Interfaces
 */
interface StateInterface
{

    /**
     * Метод формує документ word
     *
     * @param N1Request $request
     * @return \PhpOffice\PhpWord\IOFactory
     */
    public function buildingWord(N1Request $request): \PhpOffice\PhpWord\Writer\HTML;

    /**
     * Метод генерує ім'я файлу
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Метод зберігає документ в файловій системі
     *
     * @param $filename
     * @param \PhpOffice\PhpWord\IOFactory $objWriter
     */
    public function saveFileDoc(\PhpOffice\PhpWord\Writer\HTML $objWriter, string $filename): void;

    /**
     * Метод зберігає документ в базі даних
     *
     * @param $filename
     * @return State
     */
    public function saveDbDoc(string $filename): State;

    /**
     * Метод зберігає в сесії ідентифікатор документа в базі та суму
     *
     * @param int $state_id
     */
    public function saveSession(int $state_id): void;

}