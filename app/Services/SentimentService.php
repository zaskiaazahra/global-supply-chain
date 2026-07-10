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

        foreach($articles as $article){

            $text = strtolower(
                ($article['title'] ?? '') . ' ' .
                ($article['description'] ?? '')
            );

            foreach($this->positiveWords as $word){

                if(str_contains($text,$word)){

                    $positive++;

                }

            }

            foreach($this->negativeWords as $word){

                if(str_contains($text,$word)){

                    $negative++;

                }

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

            'positive'=>$positive,

            'negative'=>$negative,

            'sentiment'=>$sentiment

        ];

    }
}