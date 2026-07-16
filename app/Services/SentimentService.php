<?php

namespace App\Services;

class SentimentService
{
    private $positiveWords = [

        'growth',
        'increase',
        'profit',
        'stable',
        'improve',
        'recover',
        'success',
        'positive',
        'expand',
        'strong'

    ];

    private $negativeWords = [

        'war',
        'crisis',
        'inflation',
        'delay',
        'disaster',
        'decline',
        'conflict',
        'loss',
        'recession',
        'risk'

    ];

    public function analyze($articles)
{
    $positive = 0;
    $negative = 0;
    $neutral = 0;

    foreach($articles as $article){

        $text = strtolower(
            ($article['title'] ?? '') . ' ' .
            ($article['description'] ?? '')
        );

        $posFound = false;
        $negFound = false;

        foreach($this->positiveWords as $word){

            if(str_contains($text,$word)){

                $positive++;
                $posFound = true;

            }

        }

        foreach($this->negativeWords as $word){

            if(str_contains($text,$word)){

                $negative++;
                $negFound = true;

            }

        }

        if(!$posFound && !$negFound){

            $neutral++;

        }

    }

    if($positive > $negative){

        $sentiment = 'Positive';

    }elseif($negative > $positive){

        $sentiment = 'Negative';

    }else{

        $sentiment = 'Neutral';

    }

    return [

        'positive' => $positive,

        'negative' => $negative,

        'neutral' => $neutral,

        'sentiment' => $sentiment

    ];

}
}