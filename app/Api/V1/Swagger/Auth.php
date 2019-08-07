<?php

/**
 * @SWG\Post(
 *   path="/auth/signup",
 *   tags={"auth"},
 *   consumes={"application/x-www-form-urlencoded"},
 *   tags={"auth"},
 *   summary="Create a new User in application",
 *   @SWG\Response(response=201, description="Created"),
 *     @SWG\Parameter(
 *         name="name",
 *         in="formData",
 *         description="Name",
 *         required=true,
 *         type="string"
 *   ),
 *   @SWG\Parameter(
 *         name="email",
 *         in="formData",
 *         description="Email",
 *         required=true,
 *         type="string"
 *   ),
 *   @SWG\Parameter(
 *         name="password",
 *         in="formData",
 *         description="Password",
 *         required=true,
 *         type="string"
 *   ),
 *   @SWG\Parameter(
 *         name="password_confirmation",
 *         in="formData",
 *         description="Password Confirmation",
 *         required=true,
 *         type="string"
 *   ),
 * )
 *
 */
