<?php
/*
 * Developer: Jeselle Bacosmo <bacosmojb@army.mil.ph>
 * Created at: 10 May 2021
 *
 */


/*
 * --------------------------------------------------------------
 *                        Constant Lines
 * -------------------------------------------------------------
 * The following language lines contains the constants used inside the
 * system. It will includes the validation codes, actions etc.
 * Feel free to tweak each of these messages here.
 */

// Actions
const ACTION_CREATE = 'create';
const ACTION_UPDATE = 'update';
const ACTION_DELETE = 'delete';

// Validation/ HTTP Codes
const DATA_OK = 200;
const DATA_CREATED = 201;
const DATA_NO_CONTENT = 204;
const BAD_REQUEST = 400;
const UNAUTHORIZED_USER = 401;
const SERVER_CONFLICT = 409;
const VALIDATION_EXCEPTION = 422;
const SERVER_ERROR = 500;
