<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// // Test giao diện


// route::get('detail-question', function(){
// 	return view('question.detail_question');
// });
// route::get('create-question',function(){
// 	return view('question.create_question');
// });
// route::get('note-create-question',function(){
// 	return view('question.note_create_question');
// });
// route::get('list-documentation',function(){
// 	return view('documentation.list_documentation');
// });
// route::get('detail-documentation',function(){
// 	return view('documentation.detail_documentation');
// });
// route::get('create-documentation',function(){
// 	return view('documentation.create_documentation');
// });
// route::get('list-tag',function(){
// 	return view('tag.list_tag');
// });
// route::get('user-information',function(){
// 	return view('user.user_information');
// });
// route::get('list-user',function(){
// 	return view('user.list_user');
// });
// route::get('edit-user',function(){
// 	return view('user.edit_user');
// });
// route::get('about',function(){
// 	return view('about');
// });

//////////////////////////////////////////////////
Route::get('', function () {
    return view('index');
});

//Group Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', 'ActivityController@getActivity');

    //Question
    Route::group(['prefix' => 'question'], function() {
        Route::get('list', 'QuestionController@getList');
        Route::get('add', 'QuestionController@getAdd');
        Route::post('add', 'QuestionController@postAdd');
        Route::get('edit/{idQuestion}', 'QuestionController@getEdit');
        Route::post('edit/{idQuestion}', 'QuestionController@postEdit');
        Route::get('delete/{idQuestion}', 'QuestionController@getDelete');

        Route::group(['prefix' => 'answer'], function() {
            Route::get('list/{idQuestion}', 'AnswerController@getList');
            Route::get('add/{idQuestion}', 'AnswerController@getAdd');
            Route::post('add/{idQuestion}', 'AnswerController@postAdd');
            Route::get('edit/{idAnswer}', 'AnswerController@getEdit');
            Route::post('edit/{idAnswer}', 'AnswerController@postEdit');
            Route::get('delete/{idAnswer}', 'AnswerController@getDelete');
        });
    });

    //Documents
    Route::group(['prefix' => 'documentation'], function() {
        Route::get('list','DocumentationController@getList');
        Route::get('edit/{idDocument}', 'DocumentationController@getEdit');
        Route::post('edit/{idDocument}', 'DocumentationController@postEdit');
        Route::get('delete/{idDocument}', 'DocumentationController@getDelete');
        Route::get('add','DocumentationController@getAdd');
        Route::post('add','DocumentationController@postAdd');
        
    });

     //Subject
    Route::group(['prefix' => 'subject'], function() {
        Route::get('list','SubjectController@getList');
        Route::get('edit/{idSubject}','SubjectController@getEdit');
        Route::post('edit/{idSubject}','SubjectController@postEdit');
        Route::post('add','SubjectController@postAdd');
        Route::get('add', 'SubjectController@getAdd');
        Route::get('delete/{idSubject}', 'SubjectController@getDelete');
    });


    //User
   Route::group(['prefix' => 'user'], function() {
        Route::get('list','UserController@getList');
        Route::get('edit/{idUser}','UserController@getEditAdmin');
        Route::post('edit/{idUser}','UserController@postEditAdmin');
        Route::get('editpass/{idUser}','UserController@getResetPassword');
        Route::get('add','UserController@getAdd');
        Route::post('add','UserController@postAdd');
        
    });
    


    Route::group(['prefix' => 'comment'], function() {
        Route::get('delete/{idComment}', 'CommentController@getDelete');
    });
    
    
    Route::group(['prefix' => 'permission'], function() {
        Route::get('list', 'PermissionController@getList');
        Route::get('add', 'PermissionController@getAdd');
        Route::post('add', 'PermissionController@postAdd');
        Route::get('edit/{idPermission}', 'PermissionController@getEdit');
        Route::post('edit/{idPermission}', 'PermissionController@postEdit');
        Route::get('delete/{idPermission}', 'PermissionController@getDelete');
    });

   

    Route::group(['prefix' => 'tag'], function() {
        Route::get('list', 'TagController@getList');
        Route::get('add', 'TagController@getAdd');
        Route::post('add', 'TagController@postAdd');
        Route::get('edit/{idTag}', 'TagController@getEdit');
        Route::post('edit/{idTag}', 'TagController@postEdit');
        Route::get('delete/{idTag}', 'TagController@getDelete');
    });
});

//Group Ajax
Route::group(['prefix' => 'ajax'], function() {
    Route::get('commentsOfQuestion/{idQuestion}', 'AjaxController@getCommentsOfQuestion');
    Route::get('commentsOfDocument/{idDocument}', 'AjaxController@getCommentsOfDocument');
    Route::get('commentsOfAnswer/{idAnswer}', 'AjaxController@getCommentsOfAnswer');
    Route::get('changeActive/{type}/{id}/{value}', 'AjaxController@changeActive');
    Route::get('dismissNew/{type}/{id}', 'AjaxController@dismissNew');
    Route::get('getMoreActive/{type}/{id}', 'AjaxController@getMore');


});

//Group Questions
Route::group(['prefix' => 'question'], function() {
    Route::get('list-question/{tab}','QuestionController@ListQuestion');
    Route::get('detail/qs_{question_id}', 'QuestionController@getDetail');
    Route::get('create-question', 'QuestionController@getCreate');
    Route::get('delete/{question_id}', 'QuestionController@getDeleteQuestion');
    Route::post('vote/{question_id}', 'QuestionController@postVote');
});

//Group Answer
Route::group(['prefix'=>'answer'], function(){
    Route::post('vote/{answer_id}', 'AnswerController@postVote');
    Route::get('delete/{answer_id}', 'AnswerController@getDelete');
    Route::post('bestanswer/{answer_id}', 'AnswerController@postBestAnswer');
});

//Group Documentation
Route::group(['prefix'=>'documentation'], function(){
    Route::get('list-documentation/{subject?}/{list_tag?}/{sort?}', 'DocumentationController@getListDocumentation')->name('documentation');
    Route::get('create-documentation', 'DocumentationController@getCreateDocumentation')->name('create-documentation')->middleware('login');
    Route::post('create-documentation', 'DocumentationController@postCreateDocumentation')->name('create-documentation')->middleware('login');
});

<<<<<<< HEAD

=======
//Group Comment
Route::group(['prefix'=>'comment'], function(){
    Route::post('edit/{cmt_id}', 'CommentController@postEdit');
    Route::post('add', 'CommentController@postAdd');
    Route::get('delete/{cmt_id}', 'CommentController@getDeleteCmt');
});
>>>>>>> f7e4473a0e13c35a4d7f86238fd032ad463d8f7b
//Group Tags
Route:: group(['prefix'=>'tag'], function(){
    Route::get('/', 'TagController@getList_tag')->name('tag');
    Route::post('create-tag', 'TagController@postCreateTag')->name('create-tag')->middleware('login');
});

//Group User
Route::group(['prefix'=>'user'], function() {
    Route::get('info/user_{user_id}', 'UserController@getInfo');
    Route::get('edit-user', 'UserController@getEdit')->middleware('checklogin');
    Route::post('edit-info', 'UserController@postEditInfo');
    Route::post('edit-avatar', 'UserController@postEditAvatar');
    Route::post('edit-changepass', 'UserController@postChangePass');

});

//Group Authencation
Route::get('login', 'UserController@getLogin')->name('login')->middleware('preventLogin');
Route::post('login', 'UserController@postLogin');
Route::get('register', 'UserController@getRegister')->name('register')->middleware('preventLogin');
Route::post('register', 'UserController@postRegister');
Route::get('logout', 'UserController@getLogout')->name('logout');
Route::get('congratulation',function(){
    return view('congratulation');
<<<<<<< HEAD
})->name('congratulation');
Route::get('error_404', function(){
    return view('404_page');
})->name('404');
=======
});
>>>>>>> f7e4473a0e13c35a4d7f86238fd032ad463d8f7b


