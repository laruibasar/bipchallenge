<?php

namespace Core\DataModel;

class DataCsv extends Data
{
    private $file;

    private string $filename;

    private array $header = [];

    private array $values = [];

    /**
     * @throws DataCsvException
     */
    public function __construct($filename, $mode)
    {
        $this->filename = $filename;
        $this->file = fopen($filename, $mode);
        if ($this->file === false) {
            throw new DataCsvException("File $filename not found");
        }

        $this->load();

        fclose($this->file);
    }

    /**
     * Load values from file
     * @return void
     * @throws DataCsvException
     */
    private function load(): void
    {
        $headerLine = fgetcsv($this->file);
        if ($headerLine === false) {
            throw new DataCsvException("File $this->filename is invalid, no header available");
        }
        $this->header = $headerLine;

        while (($line = fgetcsv($this->file)) !== false) {
            $values += $line;
        }
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }
}