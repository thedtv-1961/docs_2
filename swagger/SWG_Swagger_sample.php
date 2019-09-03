<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 * 		basePath="/v1",
 * 		host="api.local",
 * 		schemes={"http"},
 * 		produces={"application/json"},
 * 		consumes={"application/json"},
 * 		@SWG\Info(
 * 			title="API",
 * 			description="REST API",
 * 			version="1.0",
 * 			termsOfService="terms",
 * 			@SWG\Contact(name="call@me.com"),
 * 			@SWG\License(name="proprietary")
 * 		),
 *
 * 		@SWG\Definition(
 * 			name="User",
 * 			required={"email", "first_name", "last_name"},
 * 			@SWG\Property(name="id", type="string", description="UUID"),
 * 			@SWG\Property(name="email", type="string"),
 * 			@SWG\Property(name="password", type="string"),
 * 			@SWG\Property(name="first_name", type="string"),
 * 			@SWG\Property(name="last_name", type="string"),
 * 			@SWG\Property(name="active", type="boolean"),
 * 		),
 * 		@SWG\Definition(
 * 	     	name="UserLock",
 * 			required={"user_id", "type", "reason"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="user_id", type="string", description="UUID"),
 * 			@SWG\Property(name="reason", type="string"),
 * 		),
 * 		@SWG\Definition(
 * 			name="Error",
 * 			required={"status", "code", "message"},
 *			@SWG\Property(name="status", type="string"),
 *			@SWG\Property(name="code", type="integer"),
 *			@SWG\Property(name="message", type="string"),
 * 		),
 * )
 */

Route::group(['prefix' => 'v1'], function() {
	/**
	 *
	 * - users ------------------------------------------------------
	 *
	 * @SWG\Get(
	 * 		path="/users/{id}",
	 * 		tags={"users"},
	 * 		operationId="getUser",
	 * 		summary="Fetch user details",
	 * 		@SWG\Parameter(
	 * 			name="id",
	 * 			in="path",
	 * 			required=true,
	 * 			type="string",
	 * 			description="UUID",
	 * 		),
	 * 		@SWG\Response(
	 * 			status=200,
	 * 			description="success",
	 * 			@SWG\Schema(ref="#/definitions/User"),
	 * 		),
	 * 		@SWG\Response(
	 * 			status="default",
	 * 			description="error",
	 * 			@SWG\Schema(ref="#/definitions/Error"),
	 * 		),
	 * 	)
	 *
	 */

	Route::get('/users/{user_id}', 'UserController@show');

	/**
	 *
	 * @SWG\Post(
	 * 		path="/users",
	 * 		tags={"users"},
	 * 		operationId="createUser",
	 * 		summary="Create new user entry",
	 * 		@SWG\Parameter(
	 * 			name="user",
	 * 			in="body",
	 * 			required=true,
	 * 			@SWG\Schema(ref="#/definitions/User"),
	 *		),
	 * 		@SWG\Response(
	 * 			status=200,
	 * 			description="success",
	 * 			@SWG\Schema(ref="#/definitions/User"),
	 * 		),
	 * 		@SWG\Response(
	 * 			status="default",
	 * 			description="error",
	 * 			@SWG\Schema(ref="#/definitions/Error"),
	 * 		),
	 * 	)
	 *
	 */
	Route::post('/users/', 'UserController@store');

	/**
	 *
	 * 	@SWG\Put(
	 * 		path="/users/{id}",
	 * 		tags={"users"},
	 * 		operationId="updateUser",
	 * 		summary="Update user entry",
	 * 		@SWG\Parameter(
	 * 			name="id",
	 * 			in="path",
	 * 			required=true,
	 * 			type="string",
	 * 			description="UUID",
	 * 		),
	 * 		@SWG\Parameter(
	 * 			name="user",
	 * 			in="body",
	 * 			required=true,
	 * 			@SWG\Schema(ref="#/definitions/User"),
	 *		),
	 * 		@SWG\Response(
	 * 			status=200,
	 * 			description="success",
	 * 		),
	 * 		@SWG\Response(
	 * 			status="default",
	 * 			description="error",
	 * 			@SWG\Schema(ref="#/definitions/Error"),
	 * 		),
	 * 	)
	 *
	 */
	Route::put('/users/{user_id}', 'UserController@update');

	/**
	 *
	 * 	@SWG\Delete(
	 * 		path="/users/{id}",
	 * 		tags={"users"},
	 * 		operationId="deleteUser",
	 * 		summary="Remove user entry",
	 * 		@SWG\Parameter(
	 * 			name="id",
	 * 			in="path",
	 * 			required=true,
	 * 			type="string",
	 * 			description="UUID",
	 * 		),
	 * 		@SWG\Response(
	 * 			status=200,
	 * 			description="success",
	 * 		),
	 * 		@SWG\Response(
	 * 			status="default",
	 * 			description="error",
	 * 			@SWG\Schema(ref="#/definitions/Error"),
	 * 		),
	 * 	)
	 *
	 */
	Route::delete('/users/{user_id}', 'UserController@destroy');

	/**
     * 	@SWG\Get(
     * 		path="/users/{user_id}/locks/{id}",
     * 		tags={"users"},
     * 		operationId="getUserLock",
     * 		summary="Fetch specified lock for user",
     * 		@SWG\Parameter(
     * 			name="user_id",
     * 			in="path",
     * 			required=true,
     * 			type="string",
     * 			description="UUID",
     * 		),
     * 		@SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="biginteger",
     * 		),
     * 		@SWG\Response(
     * 			status=200,
     * 			description="success",
     * 			@SWG\Schema(ref="#/definitions/UserLock"),
     * 		),
     * 		@SWG\Response(
     * 			status="default",
     * 			description="error",
     * 			@SWG\Schema(ref="#/definitions/Error"),
     * 		),
     * 	)
     *
     * 	@SWG\Get(
     * 		path="/users/{user_id}/locks",
     * 		tags={"users"},
     * 		operationId="listUserLocks",
     * 		summary="List user locks",
     * 		@SWG\Parameter(
     * 			name="user_id",
     * 			in="path",
     * 			required=true,
     * 			type="string",
     * 			description="UUID",
     * 		),
     * 		@SWG\Response(
     * 			status=200,
     * 			description="success",
     * 			@SWG\Schema(ref="#/definitions/UserLock"),
     * 		),
     * 		@SWG\Response(
     * 			status="default",
     * 			description="error",
     * 			@SWG\Schema(ref="#/definitions/Error"),
     * 		),
     * 	),
	 */
	Route::resource('/users/{user_id}/locks', 'UserLockController', ['only' => ['index', 'show']]);

});
