<?php

namespace App\Utils;

use DateTime;

class Utils
{
    public static function timeAgo($timestamp)
    {
        // Cria um objeto DateTime a partir do timestamp
        $dateTime = new DateTime($timestamp);
        $now = new DateTime();

        // Calcula a diferença entre as duas datas
        $difference = $now->diff($dateTime);

        // Formata a diferença em uma string
        if ($difference->y > 0) {
            return 'há ' . $difference->y . ' ano' . ($difference->y > 1 ? 's' : '');
        } elseif ($difference->m > 0) {
            return 'há ' . $difference->m . ' mês' . ($difference->m > 1 ? 'es' : '');
        } elseif ($difference->d > 0) {
            return 'há ' . $difference->d . ' dia' . ($difference->d > 1 ? 's' : '');
        } elseif ($difference->h > 0) {
            return 'há ' . $difference->h . ' hora' . ($difference->h > 1 ? 's' : '');
        } elseif ($difference->i > 0) {
            return 'há ' . $difference->i . ' minuto' . ($difference->i > 1 ? 's' : '');
        } else {
            return 'agora';
        }
    }
}
