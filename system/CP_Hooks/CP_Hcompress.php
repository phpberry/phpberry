<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}
function sanitize_output($buffer)
{
    ini_set('pcre.recursion_limit', '16777');
    $re = '%# Collapse whitespace everywhere but in blacklisted elements.
            (?>             # Match all whitespans other than single space.
            [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
            | \s{2,}        # or two or more consecutive-any-whitespace.
            ) # Note: The remaining regex consumes no text at all...
            (?=             # Ensure we are not in a blacklist tag.
            [^<]*+        # Either zero or more non-"<" {normal*}
            (?:           # Begin {(special normal*)*} construct
            <           # or a < starting a non-blacklist tag.
            (?!/?(?:textarea|pre|script)\b)
            [^<]*+      # more non-"<" {normal*}
            )*+           # Finish "unrolling-the-loop"
            (?:           # Begin alternation group.
            <           # Either a blacklist start tag.
            (?>textarea|pre|script)\b
            | \z          # or end of file.
            )             # End alternation group.
            )  # If we made it here, we are not in a blacklist tag.
            %Six';
    return preg_replace($re, ' ', $buffer);
}

ob_start('sanitize_output');
