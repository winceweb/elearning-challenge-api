<?php
namespace App\Http\Controllers;
use App\Lesson;
use App\Rating;
use Illuminate\Http\Request;
use App\Transformer\RatingTransformer;
/**
 * Manage an Author's Ratings
 */
class LessonRatingsController extends Controller
{
    public function store(Request $request, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $rating = Rating::create([
            'value' => $request->get('value')
          ]);
        return $this->success("Vote Reussi", 201);
    }
    /**
     * @param $lessonId
     * @param $ratingId
     * @return \Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy($lessonId, $ratingId)
    {
        /** @var \App\Author $lesson */
        $lesson = Lesson::find($lessonId);
        $lesson
            ->ratings()
            ->findOrFail($ratingId)
            ->delete();
        return $this->success("Le vote a été suprimé", 204);
    }
 }
