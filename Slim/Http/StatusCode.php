<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */

namespace Slim\Http;

class StatusCode
{
    final const HTTP_CONTINUE = 100;
    final const HTTP_SWITCHING_PROTOCOLS = 101;
    final const HTTP_PROCESSING = 102;

    final const HTTP_OK = 200;
    final const HTTP_CREATED = 201;
    final const HTTP_ACCEPTED = 202;
    final const HTTP_NONAUTHORITATIVE_INFORMATION = 203;
    final const HTTP_NO_CONTENT = 204;
    final const HTTP_RESET_CONTENT = 205;
    final const HTTP_PARTIAL_CONTENT = 206;
    final const HTTP_MULTI_STATUS = 207;
    final const HTTP_ALREADY_REPORTED = 208;
    final const HTTP_IM_USED = 226;

    final const HTTP_MULTIPLE_CHOICES = 300;
    final const HTTP_MOVED_PERMANENTLY = 301;
    final const HTTP_FOUND = 302;
    final const HTTP_SEE_OTHER = 303;
    final const HTTP_NOT_MODIFIED = 304;
    final const HTTP_USE_PROXY = 305;
    final const HTTP_UNUSED= 306;
    final const HTTP_TEMPORARY_REDIRECT = 307;
    final const HTTP_PERMANENT_REDIRECT = 308;

    final const HTTP_BAD_REQUEST = 400;
    final const HTTP_UNAUTHORIZED  = 401;
    final const HTTP_PAYMENT_REQUIRED = 402;
    final const HTTP_FORBIDDEN = 403;
    final const HTTP_NOT_FOUND = 404;
    final const HTTP_METHOD_NOT_ALLOWED = 405;
    final const HTTP_NOT_ACCEPTABLE = 406;
    final const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    final const HTTP_REQUEST_TIMEOUT = 408;
    final const HTTP_CONFLICT = 409;
    final const HTTP_GONE = 410;
    final const HTTP_LENGTH_REQUIRED = 411;
    final const HTTP_PRECONDITION_FAILED = 412;
    final const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    final const HTTP_REQUEST_URI_TOO_LONG = 414;
    final const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    final const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    final const HTTP_EXPECTATION_FAILED = 417;
    final const HTTP_IM_A_TEAPOT = 418;
    final const HTTP_MISDIRECTED_REQUEST = 421;
    final const HTTP_UNPROCESSABLE_ENTITY = 422;
    final const HTTP_LOCKED = 423;
    final const HTTP_FAILED_DEPENDENCY = 424;
    final const HTTP_UPGRADE_REQUIRED = 426;
    final const HTTP_PRECONDITION_REQUIRED = 428;
    final const HTTP_TOO_MANY_REQUESTS = 429;
    final const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    final const HTTP_CONNECTION_CLOSED_WITHOUT_RESPONSE = 444;
    final const HTTP_UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    final const HTTP_CLIENT_CLOSED_REQUEST = 499;

    final const HTTP_INTERNAL_SERVER_ERROR = 500;
    final const HTTP_NOT_IMPLEMENTED = 501;
    final const HTTP_BAD_GATEWAY = 502;
    final const HTTP_SERVICE_UNAVAILABLE = 503;
    final const HTTP_GATEWAY_TIMEOUT = 504;
    final const HTTP_VERSION_NOT_SUPPORTED = 505;
    final const HTTP_VARIANT_ALSO_NEGOTIATES = 506;
    final const HTTP_INSUFFICIENT_STORAGE = 507;
    final const HTTP_LOOP_DETECTED = 508;
    final const HTTP_NOT_EXTENDED = 510;
    final const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;
    final const HTTP_NETWORK_CONNECTION_TIMEOUT_ERROR = 599;
}
