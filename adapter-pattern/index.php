<?php

interface MediaPlayer
{
    public function play($type);
}

interface AdvanceMediaPlayer
{
    public function playVlc();

    public function playMp4();
}

class Mp4Player implements AdvanceMediaPlayer
{

    public function playMp4()
    {
        echo "Playing mp4 <br>";
    }

    public function playVlc()
    {
    }

}

class VlcPlayer implements AdvanceMediaPlayer
{

    public function playMp4()
    {
    }

    public function playVlc()
    {
        echo "playing vlc <br>";
    }

}


class MediaAdapter implements MediaPlayer
{
    private $advancePlayer;

    public function __construct($type = 'audio')
    {
        if ($type === 'vlc') {
            $this->advancePlayer = new VlcPlayer();
        } elseif ($type == 'mp4') {
            $this->advancePlayer = new Mp4Player();
        }
    }

    public function play($type = 'mp4')
    {
        if ($type == 'mp4') {
            $this->advancePlayer->playMp4();
        } elseif ($type == 'vlc') {
            $this->advancePlayer->playVlc();
        }
    }

}

class AudioPlayer implements MediaPlayer
{
    private $mediaAdapter;

    public function play($type)
    {
        if ($type == 'audio') {
            echo "playing audio <br>";
        } elseif ($type == 'mp4') {
            $this->mediaAdapter = new Mp4Player();
            $this->mediaAdapter->playMp4();
        } elseif ($type == 'vlc') {
            $this->mediaAdapter = new VlcPlayer();
            $this->mediaAdapter->playVlc();
        }
    }

}

$audioPlayer = new AudioPlayer();
$audioPlayer->play('audio');
$audioPlayer->play('mp4');
$audioPlayer->play('vlc');

