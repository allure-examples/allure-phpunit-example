<?php

namespace Yandex\Allure\Adapter\Example;

use PHPUnit_Framework_TestCase;
use Yandex\Allure\Adapter\Annotation\Title;
use Yandex\Allure\Adapter\Support\AttachmentSupport;

/**
 * @package Yandex\Allure\Adapter\Example
 * @Title("Tests with attachments")
 */
class AttachmentsTest extends PHPUnit_Framework_TestCase
{
    use AttachmentSupport;

    /**
     * @Title("Attachment processing test")
     */
    public function testProcessAttachments()
    {
        $filePathFromMethod = $this->outputSomeContentToTemporaryFile();
        $this->addAttachment($filePathFromMethod, 'Content from temporary file', 'text/plain');
        $this->assertTrue(file_exists($filePathFromMethod));

        $contentsFromMethod = $this->outputSomeContentDirectly();
        $this->addAttachment($contentsFromMethod, 'Content from method return type', 'text/html');
        $this->assertTrue(strlen($contentsFromMethod) > 0);

    }

    private function outputSomeContentToTemporaryFile()
    {
        $tmpPath = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($tmpPath, 'Some content to be outputted to temporary file.');
        return $tmpPath;
    }

    private function outputSomeContentDirectly()
    {
        return 'Some content to be outputted as method return value.';
    }

    private function getUrl()
    {
        return 'http://allure.qatools.ru/';
    }

}
