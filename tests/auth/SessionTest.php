<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\io\RawStream;
use im\auth\StreamSession;
use im\auth\FileSession;

final class SessionTest extends TestCase {

    /**
     *
     */
    public function test_streamSession(): void {
        $stream = new RawStream();
        $session = new StreamSession(null, $stream);
        $session->set("name", "Some Value");
        $session->save();

        $this->assertEquals(
            'a:1:{s:4:"name";s:10:"Some Value";}',
            $stream->toString()
        );

        $session = new StreamSession(null, $stream);

        $this->assertEquals(
            'Some Value',
            $session->get("name")
        );
    }

    /**
     *
     */
    public function test_fileSession(): void {
        $session = new FileSession(null, __DIR__);
        $session->set("name", "Some Value");
        $session->save();

        $this->assertEquals(
            true,
            is_file( $file = sprintf("%s/sess_%s", __DIR__, $id = $session->id) )
        );

        if (is_file($file)) {
            $this->assertEquals(
                'a:1:{s:4:"name";s:10:"Some Value";}',
                file_get_contents($file)
            );

            $session = new FileSession($id, __DIR__);

            $this->assertEquals(
                'Some Value',
                $session->get("name")
            );

            unlink($file);
        }
    }
}
