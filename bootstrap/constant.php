<?php

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
const FORBIDDEN = 403;
const HTTP_NOT_FOUND = 404;
const METHOD_NOT_ALLOWED = 405;
const SERVER_CONFLICT = 409;
const VALIDATION_EXCEPTION = 422;
const SERVER_ERROR = 500;
