<?php

namespace Core\DataModel;

use Core\App;

class DataCsv extends Data implements DataInterface
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
        $this->filename = App::$basePath . DIRECTORY_SEPARATOR . $filename;
        $this->open($mode);
        $this->loadHeader();
        $this->close();
        $this->file = null;
    }

    /**
     * Load values from file
     * @return void
     * @throws DataCsvException
     */
    private function load(): void
    {
        $this->clearHeader();

        while (($line = fgetcsv($this->file)) !== false) {
            $this->values += $line;
        }
    }

    /**
     * Fill header to gather fields.
     * @return void
     * @throws DataCsvException
     */
    private function loadHeader(): void
    {
        $headerLine = fgetcsv($this->file);
        if ($headerLine === false) {
            throw new DataCsvException("File $this->filename is invalid, no header available");
        }
        $this->header = array_map(fn($value): string => trim($value), $headerLine);
    }

    /**
     * Close file pointer
     * @return void
     */
    public function close(): void
    {
        fclose($this->file);
    }

    /**
     * Open file, storing the file pointer. Works as re-opener.
     * @param $mode
     * @return void
     * @throws DataCsvException
     */
    public function open($mode = 'r'): void
    {
        if (isset($this->file) || $this->file === false) {
            $this->close();
        }

        $this->file = fopen($this->filename, $mode);
        if ($this->file === false) {
            throw new DataCsvException("File $this->filename not found");
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

    /**
     * @param string $field
     * @param $value
     * @return array|null
     * @throws DataCsvException
     */
    public function find(string $field, $value): ?array
    {
        $idx = $this->headerIndex($field);
        if ($idx < 0) {
            throw new DataCsvException("Data field $field is not available");
        }

        $this->open();
        $this->clearHeader();

        $result = [];
        while (($line = fgetcsv($this->file)) !== false) {
            if ($line[$idx] == $value) {
                $result = array_combine($this->header, $line);
                break;
            }
        }

        return $result;
    }

    /**
     * Get the index for the header column
     * @param string $field
     * @return int
     */
    private function headerIndex(string $field): int
    {
        $idx = -1;
        foreach ($this->header as $header) {
            if (mb_strtolower($header) === mb_strtolower($field)) {
                $idx = key($this->header);
            }
        }
        return $idx;
    }

    private function clearHeader(): void
    {
        fgetcsv($this->file);
    }

}