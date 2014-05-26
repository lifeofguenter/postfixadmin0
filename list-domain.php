<?php

require_once 'common.php';

authentication_require_role('admin');

if (authentication_has_role('global-admin')) {
   $list_admins = list_admins ();
   $is_superadmin = 1;
   $fUsername = escape_string(safepost('fUsername', safeget('username'))); # prefer POST over GET variable
   if ($fUsername != "") $admin_properties = get_admin_properties($fUsername);
} else {
   $list_admins = array(authentication_get_username());
   $is_superadmin = 0;
   $fUsername = "";
}

$list_all_domains = 0;
if (isset($admin_properties) && $admin_properties['domain_count'] == 'ALL') { # list all domains for superadmins
   $list_all_domains = 1;
} elseif (!empty($fUsername)) {
  $list_domains = list_domains_for_admin ($fUsername);
} elseif ($is_superadmin) {
   $list_all_domains = 1;
} else {
   $list_domains = list_domains_for_admin(authentication_get_username());
}

$table_domain  = table_by_key('domain');
$table_mailbox = table_by_key('mailbox');
$table_alias   = table_by_key('alias');

if ($list_all_domains == 1) {
   $where = " WHERE $table_domain.domain != 'ALL' "; # TODO: the ALL dummy domain is annoying...
} else {
   $list_domains = escape_string($list_domains);
   $where = " WHERE $table_domain.domain IN ('" . join("','", $list_domains) . "') ";
}

# fetch domain data and number of mailboxes
# PgSQL requires the extensive GROUP BY statement (https://sourceforge.net/forum/message.php?msg_id=7386240)
# and also in the field list (https://sourceforge.net/tracker/?func=detail&aid=2859165&group_id=191583&atid=937964)
# Note: future versions should auto-generate the field list based on $struct in DomainHandler (use all fields from the domain table)
$table_domain_fieldlist = "
   $table_domain.domain, $table_domain.description, $table_domain.aliases, $table_domain.mailboxes,
   $table_domain.maxquota, $table_domain.quota, $table_domain.transport, $table_domain.backupmx, $table_domain.created,
   $table_domain.modified, $table_domain.active
";

$query = "
   SELECT $table_domain_fieldlist , COUNT( DISTINCT $table_mailbox.username ) AS mailbox_count
   FROM $table_domain
   LEFT JOIN $table_mailbox ON $table_domain.domain = $table_mailbox.domain
   $where
   GROUP BY $table_domain_fieldlist
   ORDER BY $table_domain.domain
   ";
$result = db_query($query);

$domain_properties = array();
while ($row = db_array ($result['result'])) {
   $domain_properties[$row['domain']] = $row;
}

# fetch number of aliases
# doing this separate is much faster than doing it in one "big" query
$query = "
   SELECT $table_domain.domain, COUNT( DISTINCT $table_alias.address ) AS alias_count
   FROM $table_domain
   LEFT JOIN $table_alias ON $table_domain.domain = $table_alias.domain
   $where
   GROUP BY $table_domain.domain
   ORDER BY $table_domain.domain
   ";

$result = db_query($query);

while ($row = db_array ($result['result'])) {
   # add number of aliases to $domain_properties array. mailbox aliases do not count.
   $domain_properties [$row['domain']] ['alias_count'] = $row['alias_count'] - $domain_properties [$row['domain']] ['mailbox_count'];
}

$template_title = 'Domain List - Postfix Admin (Zero)';
include 'templates/header.php';
include 'templates/menu.php';

if ($is_superadmin)
{
    include 'templates/admin_list-domain.php';
}
else
{
    include 'templates/overview-get.php';
}
include 'templates/footer.php';