<?php
 
namespace App\Transformer;
 
class ProjectTransformer {
 
    public function transform($project) {
        return [
            'id' => $project->id,
            'project' => $project->description
        ];
    }
 
}