<?php

if (! empty($greeting)) {
    echo $greeting, "\n\n";
} else {
    echo $level == 'error' ? 'おっと！' : 'こんにちは！', "\n\n";
}

if (! empty($introLines)) {
    echo implode("\n", $introLines), "\n\n";
}

if (isset($actionText)) {
    echo "{$actionText}: {$actionUrl}", "\n\n";
}

if (! empty($outroLines)) {
    echo implode("\n", $outroLines), "\n\n";
}

echo 'よろしくお願いいたします、', "\n";
echo config('app.name'), "\n";