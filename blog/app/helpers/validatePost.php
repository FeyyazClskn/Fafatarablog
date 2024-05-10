<?php

function validatePost($post)
{
  
    $errors = array();

    if (empty($post['title'])) {
        array_push($errors, 'Başlık gerekli!');
    }

    if (empty($post['body'])) {
        array_push($errors, 'Açıklama gerekli!');
    }
    
    if (empty($post['topic_id'])) {
        array_push($errors, 'Konu seçmeniz gerekli!');
    }

    $existingPost = selectOne('posts', ['title'=> $post['title']]);
    if ($existingPost) {
        if (isset($post['update-post']) && $existingPost['id'] != $post['id']) {
            array_push($errors, 'Aynı başlık ile daha önceden post atılmış!');
        }
        if (isset($post['add-post'])) {
            array_push($errors, 'Aynı başlık ile daha önceden post atılmış!');
        }
    }

    return $errors;
}