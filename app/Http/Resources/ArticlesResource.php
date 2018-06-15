<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Comment;
use App\User;

class ArticlesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'data' => ArticleResource::collection($this->collection),
        ];

    }


    public function with($request)
    {
        $comments = $this->collection->flatMap(
            function ($article){
                return $article->comments;
            }
        );

        $authors = $this->collection->map(function($article){
            return $article->author;
        });


        $included = $authors->merge($comments)->unique();

        return [
            'links' => [
                'self' => route('articles.index')
            ],
            'included' => $this->withIncluded($included)
        ];
    }


    public function withIncluded(Collection $included){
        return $included->map(function ($include){

            if($include instanceof Comment)
            {
                return new CommentResource($include);

            }
            if($include instanceof User)
            {
                return new UserResource($include);
            }

        });

    }
}
