<?php

declare(strict_types=1);

namespace Jasny\Persist\SQL\Query\Dialect;

/**
 * Constants for the PostgreSQL dialect of SQL.
 */
class PostgreSQL extends Generic
{
    public const NAME = 'PostgreSQL';

    public const REGEX_VALUE = '(?:\w++|"[^"]*+"|\'(?:[^\'\\\\]++|\\\\.)*+\'|\s++|[^"\'\w\s])*?';
    public const REGEX_QUOTED = '(?:"[^"]*+"|\'(?:[^\'\\\\]++|\\\\.)*+\')';
    public const REGEX_QUOTED_STRING = '(?:\'(?:[^\'\\\\]++|\\\\.)*+\')';
    public const REGEX_QUOTED_IDENTIFIER = '(?:"[^"]*+")';
    public const REGEX_IDENTIFIER = '(?:"[^"]*+"|\d*[a-z_]\w*+)';
    public const REGEX_FULL_IDENTIFIER = '(?:(?:\d*[a-z_]\w*+|"[^"]*+")(?:\.(?:\d*[a-z_]\w*+|"[^"]*+")){0,2})';
    public const REGEX_UNQUOTED_IDENTIFIER = '(?:\d*[a-z_][^\s,.`\'"()]*)';
    public const REGEX_CHARS_QUOTES = '\'"';

    public const REGEX_CAPTURE_QUERY_TYPE = '(?:(?<type>SELECT|INSERT|REPLACE|UPDATE|DELETE|TRUNCATE|CALL|DO|ALTER'
        . '|CREATE|DROP|RENAME|PREPARE|EXECUTE|DEALLOCATE|DESCRIBE|EXPLAIN|ANALYZE|BEGIN|COMMIT|ROLLBACK|SAVEPOINT|'
        . 'RELEASE SAVEPOINT|SET|SHOW|LOCK|UNLOCK|GRANT|REVOKE|VACUUM|ANALYZE|REINDEX|CLUSTER|LISTEN|NOTIFY|UNLISTEN|'
        . 'DISCARD|COPY|REFRESH\s+MATERIALIZED\s+VIEW|RESET|START\s+TRANSACTION|ABORT)\b)';
    public const REGEX_KEYWORDS = '(?:NULL|TRUE|FALSE|DEFAULT|AND|OR|NOT|IN|IS|BETWEEN|LIKE|ILIKE|SIMILAR\s+TO|'
        . 'MATCH|AS|CASE|WHEN|THEN|END|ASC|DESC|BINARY|TYPEOF|CAST|COALESCE|GREATEST|LEAST)';
    public const REGEX_SELECT_MODS = '(?:ALL|DISTINCT|DISTINCTON|FOR\s+UPDATE|FOR\s+SHARE|FOR\s+NO\s+KEY\s+UPDATE|'
        . 'FOR\s+KEY\s+SHARE)';
    public const REGEX_SELECT_OPTIONS = '(?:PROCEDURE|INTO|FOR\s+UPDATE|FOR\s+SHARE|CASCADE\s*ON)';
    public const REGEX_INSERT_MODS = '(?:ON\s+CONFLICT\s+DO\s+NOTHING|ON\s+CONFLICT\s+DO\s+UPDATE)';
    public const REGEX_UPDATE_MODS = '(?:RETURNING)';
    public const REGEX_DELETE_MODS = '(?:USING|RETURNING)';
    public const REGEX_JOIN = '(?:(?:NATURAL\s+)?(?:(?:LEFT|RIGHT)\s+)?(?:(?:INNER|CROSS|OUTER|FULL)\s+)?JOIN)';
    public const REGEX_LOOKBEHIND_JOIN = '(?<!\bNATURAL)(?<!\bLEFT)(?<!\bRIGHT)(?<!\bINNER)(?<!\bCROSS)(?<!\bOUTER)'
        . '(?<!\bFULL)(?<!\bJOIN)';

    public const QUOTE_STRING = '\'';
    public const QUOTE_IDENTIFIER = '"';

    /**
     * Quote a string to be used in an SQL query.
     */
    public function quoteString(string $value): string
    {
        return
            static::QUOTE_STRING .
            addcslashes($value, "\0\r\n\f\t" . static::QUOTE_STRING) .
            static::QUOTE_STRING;
    }
}

