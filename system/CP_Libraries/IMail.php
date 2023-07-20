<?php

declare(strict_types=1);

interface IMail
{
    public function mail($to, $from, $subject, $message, $file = ''): void;
}
