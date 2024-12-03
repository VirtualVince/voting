<?php

class TimeFormatter {
    public static function formatTimestamp($timestamp) {
        $timeDifference = time() - $timestamp;
        if ($timeDifference < 60) {
            return $timeDifference . ' seconds ago';
        } elseif ($timeDifference < 3600) {
            return floor($timeDifference / 60) . ' minutes ago';
        } elseif ($timeDifference < 86400) {
            return floor($timeDifference / 3600) . ' hours ago';
        } elseif ($timeDifference < 2592000) {
            return floor($timeDifference / 86400) . ' days ago';
        } elseif ($timeDifference < 31536000) {
            return floor($timeDifference / 2592000) . ' months ago';
        } else {
            return date('M d, Y', $timestamp);
        }
    }
}