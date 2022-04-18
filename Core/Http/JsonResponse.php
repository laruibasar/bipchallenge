<?php

namespace Core\Http;

class JsonResponse extends HttpResponse
{
    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        $headers += ['Content-Type' => 'text/json'];
        parent::__construct(json_encode($content), $status, $headers);
    }

    public function __toString(): string
    {
        $this->sendHeaders();
        http_response_code($this->statusCode);
        return $this->getContent();
    }

    public function getContent(): string
    {
        if (empty($this->content)) {
            return '';
        } elseif (str_starts_with($this->content, '{')) {
            return $this->content;
        } else {
            return json_encode($this->content);
        }
    }
}