<?php

namespace App\Mail\Message;

interface EmailMessageInterface
{
    public function setCopy(string $file, array $params = []): EmailMessageInterface;
    public function mergeCopy(string $file, array $params = []): EmailMessageInterface;
    public function subject(): string;
    public function setSubject(string $key): EmailMessageInterface;
    public function setTitle(string $key): EmailMessageInterface;
    public function setFeatureText(string $key): EmailMessageInterface;
    public function addSection(): EmailMessageInterface;
    public function addHeading(string $key): EmailMessageInterface;
    public function addParagraphs(string $key): EmailMessageInterface;
    public function addBullets(string $key, string $img = null): EmailMessageInterface;
    public function addButton(string $key, string $href, bool $makeSafeButton = false): EmailMessageInterface;
    public function addMultiBullets(string $key): EmailMessageInterface;
    public function startMultiBullets(): EmailMessageInterface;
    public function addMultiBullet(string $key, string $img = null): EmailMessageInterface;
    public function addSubBullets(string $key, string $img = null): EmailMessageInterface;
    public function endMultiBullets(): EmailMessageInterface;
    public function view(): string;
    public function vars() : array;
}
