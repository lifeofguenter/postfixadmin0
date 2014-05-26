<?php if( !defined('POSTFIXADMIN') ) die( "This file cannot be used standalone." ); ?>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h2><?php echo html_escape($PALANG['pOverview_welcome'] . $fDomain) ?></h2>
        </div>
        <div class="col-md-4 margin-top-20">
            <form name="overview" method="get" class="form-inline pull-right">
                <select name="domain" class="selectpicker" onchange="this.form.submit();">
                <?php if (!empty($list_domains) && is_array($list_domains)): ?>
                <?php foreach($list_domains as $list_domain): ?>
                    <option value="<?php echo html_escape($list_domain) ?>"<?php echo (($fDomain == $list_domain) ? ' selected' : '') ?>><?php echo html_escape($list_domain) ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
                </select>
                <button type="submit" class="btn btn-default"><?php print $PALANG['pOverview_button']; ?></button>
            </form>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-aliasdomains" data-toggle="tab">Alias Domain</a></li>
        <li><a href="#tab-aliases" data-toggle="tab"><?php echo html_escape($PALANG['pOverview_alias_title']) ?></a></li>
        <li><a href="#tab-mailboxes" data-toggle="tab">Mailboxes</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active" id="tab-aliasdomains">a</div>
        <div class="tab-pane fade" id="tab-aliases">

            <div class="row">
                <div class="col-md-8">
                    <h3>
                        <?php echo html_escape($PALANG['pOverview_alias_title']) ?>
                        <small>
                            <?php if ($limit['aliases'] < 0): ?>
                            <?php echo html_escape($PALANG['pOverview_disabled']) ?>
                            <?php elseif ($limit['aliases'] == 0): ?>
                            <?php echo html_escape($PALANG['pOverview_unlimited']) ?>
                            <?php else: ?>
                            <?php echo html_escape($limit['alias_count'] . ' / ' . $limit['aliases']) ?>
                            <?php endif; ?>
                        </small>
                    </h3>
                </div>
                <div class="col-md-4 margin-top-20">
                    <?php if ($tCanAddAlias): ?>
                    <a class="btn btn-default pull-right" href="create-alias.php?domain=<?php echo urlencode($fDomain) ?>"><?php echo html_escape($PALANG['pMenu_create_alias']) ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?php echo html_escape($PALANG['pOverview_alias_address']) ?></th>
                        <th><?php echo html_escape($PALANG['pOverview_alias_goto']) ?></th>
                        <th><?php echo html_escape($PALANG['pOverview_alias_modified']) ?></th>
                        <th><?php echo html_escape($PALANG['pOverview_alias_active']) ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($tAlias) && is_array($tAlias)): ?>
                    <?php foreach($tAlias as $each): ?>
                    <tr>
                        <td><?php echo html_escape($each['address']) ?></td>
                        <td><?php echo html_escape(str_replace(',', '<br>', $each['goto']))?></td>
                        <td><?php echo html_escape($each['modified']) ?></td>
                        <?php if (
                            authentication_has_role('global-admin') ||
                            !empty($CONF['special_alias_control']) ||
                            check_alias_owner($SESSID_USERNAME, $each['address'])
                        ): ?>
                            <td>
                                <a href="edit-active.php?<?php echo http_build_query(array(
                                    'alias' => $each['address'],
                                    'domain' => $fDomain,
                                    'return' => 'list-virtual.php?domain=' . urlencode($fDomain),
                                )) ?>"><?php echo html_escape((($each['active'] == 1) ? $PALANG['YES'] : $PALANG['NO'])) ?></a>
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <a class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" href="#">Action <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="edit-alias.php?address=<?php echo urlencode($each['address']) ?>"><?php echo html_escape($PALANG['edit']) ?></a></li>
                                        <li><a href="delete.php?table=alias&delete=<?php echo urlencode($each['address']) ?>&domain=<?php echo urlencode($fDomain) ?>" onclick="return confirm('Are you sure?')"><?php echo html_escape($PALANG['del']) ?></a></li>
                                    </ul>
                                </div>
                            </td>
                        <?php else: ?>
                            <?php if ($each['active'] == 1): ?>
                                <td><?php echo html_escape($PALANG['YES']) ?></td>
                            <?php else: ?>
                                <td><?php echo html_escape($PALANG['NO']) ?></td>
                            <?php endif; ?>
                            <td></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-mailboxes">

            <div class="row">
                <div class="col-md-8">
                    <h3>
                        <?php echo html_escape($PALANG['pOverview_mailbox_title']) ?>
                        <small>
                            <?php if ($limit['mailboxes'] < 0): ?>
                            <?php echo html_escape($PALANG['pOverview_disabled']) ?>
                            <?php elseif ($limit['mailboxes'] == 0): ?>
                            <?php echo html_escape($PALANG['pOverview_unlimited']) ?>
                            <?php else: ?>
                            <?php echo html_escape($limit['mailbox_count'] . ' / ' . $limit['mailboxes']) ?>
                            <?php endif; ?>
                        </small>
                    </h3>
                </div>
                <div class="col-md-4 margin-top-20">
                    <?php if ($tCanAddMailbox): ?>
                    <a class="btn btn-default pull-right" href="create-mailbox.php?domain=<?php echo urlencode($fDomain) ?>"><?php echo html_escape($PALANG['pMenu_create_mailbox']) ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?php echo html_escape($PALANG['pOverview_mailbox_username']) ?></th>
                        <?php if ($display_mailbox_aliases): ?>
                        <th><?php echo html_escape($PALANG['pOverview_alias_goto']) ?></th>
                        <?php endif; ?>
                        <th><?php echo html_escape($PALANG['pOverview_mailbox_name']) ?></th>
                        <?php if (!empty($CONF['quota'])): ?>
                        <th><?php echo html_escape($PALANG['pOverview_mailbox_quota']) ?></th>
                        <?php endif; ?>
                        <th><?php echo html_escape($PALANG['pOverview_mailbox_modified']) ?></th>
                        <th><?php echo html_escape($PALANG['pOverview_mailbox_active']) ?></th>
                        <?php if (!empty($conf['vacation_control_admin'])): ?>
                        <th>Vacation</th>
                        <?php endif; ?>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($tMailbox) && is_array($tMailbox)): ?>
                    <?php foreach($tMailbox as $each): ?>
                    <tr>
                        <td><?php echo html_escape($each['username']) ?></td>
                        <?php if ($display_mailbox_aliases): ?>
                        <td>
                            <?php if ($each['goto_mailbox'] == 1): ?>
                            Mailbox
                            <?php else: ?>
                            Forward only
                            <?php endif;?>
                            <?php if (!empty($each['goto_other']) && is_array($each['goto_other'])): ?>
                            <?php echo html_escape(implode('<br>', $each['goto_other'])) ?>
                            <?php endif;?>
                        </td>
                        <?php endif; ?>
                        <td><?php echo html_escape($each['name']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php

        if (sizeof ($tMailbox) > 0) {


   $colspan=8;
           if ($CONF['vacation_control_admin'] == 'YES') $colspan=$colspan+1;
           if ($CONF['alias_control_admin'] == 'YES') $colspan=$colspan+1;
           if ($display_mailbox_aliases)              $colspan=$colspan+1;

           print "<table id=\"mailbox_table\">\n";

   print "   <tr class=\"header\">\n";
   if ($CONF['show_status'] == 'YES') { print "<td></td>\n"; }
               print "      <td>" . $PALANG['pOverview_mailbox_username'] . "</td>\n";
                   if ($display_mailbox_aliases) print "      <td>" . $PALANG['pOverview_alias_goto'] . "</td>\n";
                   print "      <td>" . $PALANG['pOverview_mailbox_name'] . "</td>\n";
                   if ($CONF['quota'] == 'YES') print "      <td>" . $PALANG['pOverview_mailbox_quota'] . "</td>\n";
                       print "      <td>" . $PALANG['pOverview_mailbox_modified'] . "</td>\n";
   print "      <td>" . $PALANG['pOverview_mailbox_active'] . "</td>\n";
           $colspan = $colspan - 6;
           print "      <td colspan=\"$colspan\">&nbsp;</td>\n";
           print "   </tr>\n";

           for ($i = 0; $i < sizeof ($tMailbox); $i++)
           {
           if ((is_array ($tMailbox) and sizeof ($tMailbox) > 0))
      {
         print "   <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";





                       if ($CONF['quota'] == 'YES')
                       {
                       print "      <td>";
            if ($tMailbox[$i]['quota'] == 0)
           {
           print $PALANG['pOverview_unlimited'];
                           }
                       elseif ($tMailbox[$i]['quota'] < 0)
                       {
                       print $PALANG['pOverview_disabled'];
                       }
                       else
                       {
                       if (boolconf('used_quotas'))
                       print divide_quota ($tMailbox[$i]['current']).'/';
                       print divide_quota ($tMailbox[$i]['quota']);
                   }
                       print "</td>\n";
        }
        print "      <td>" . $tMailbox[$i]['modified'] . "</td>\n";
        $active = ($tMailbox[$i]['active'] == 1) ? $PALANG['YES'] : $PALANG['NO'];
            print "      <td><a href=\"edit-active.php?username=" . urlencode ($tMailbox[$i]['username']) . "&domain=$fDomain" . "\">" . $active . "</a></td>\n";

            if ($CONF['vacation_control_admin'] == 'YES' && $CONF['vacation'] == 'YES')
        {
                $v_active_int = $tMailbox[$i]['v_active'];
                if($v_active_int !== -1) {
                if($v_active_int == 1) {
                $v_active = $PALANG['pOverview_vacation_edit'];
        }
        else {
        $v_active = $PALANG['pOverview_vacation_option'];
        }
               print "<td><a href=\"edit-vacation.php?username=" . urlencode ($tMailbox[$i]['username']) . "&domain=$fDomain" . "\">" . $v_active . "</a></td>\n";
        }
        else {
        // can't tell vacation state - broken pgsql query
        echo "<td> &nbsp; </td>\n";
        }
        }

            $edit_aliases=0;
            if ( (! authentication_has_role('global-admin')) && $CONF['alias_control_admin'] == 'YES') $edit_aliases = 1;
            if (    authentication_has_role('global-admin')  && $CONF['alias_control'] == 'YES') $edit_aliases = 1;

            if ($edit_aliases == 1)
            {
            print "      <td><a href=\"edit-alias.php?address=" . urlencode ($tMailbox[$i]['username']) . "\">" . $PALANG['pOverview_alias_edit'] . "</a></td>\n";
            }

            print "      <td><a href=\"edit-mailbox.php?username=" . urlencode ($tMailbox[$i]['username']) . "&domain=$fDomain" . "\">" . $PALANG['edit'] . "</a></td>\n";
            print "      <td><a href=\"delete.php?table=mailbox" . "&delete=" . urlencode ($tMailbox[$i]['username']) . "&domain=$fDomain" . "\"onclick=\"return confirm ('" . $PALANG['confirm'] . $PALANG['pOverview_get_mailboxes'] . ": ". $tMailbox[$i]['username'] . "')\">" . $PALANG['del'] . "</a></td>\n";
            print "   </tr>\n";
      }
        }
        print "</table>\n";
        print "<div id=\"nav_bar\"><a name=\"LowArrow\" /a>\n";
        if ($tDisplay_back_show == 1)
            {
            print "<a href=\"$file?domain=$fDomain&limit=$tDisplay_back#LowArrow\"><img border=\"0\" src=\"images/arrow-l.png\" title=\"" . $PALANG['pOverview_left_arrow'] . "\" alt=\"" . $PALANG['pOverview_left_arrow'] . "\" /></a>\n";
            }
            if ($tDisplay_up_show == 1)
            {
                print "<a href=\"$file?domain=$fDomain&limit=0#LowArrow\"><img border=\"0\" src=\"images/arrow-u.png\" title=\"" . $PALANG['pOverview_up_arrow'] . "\" alt=\"" . $PALANG['pOverview_up_arrow'] . "\" /></a>\n";
            }
            if ($tDisplay_next_show == 1)
            {
            print "<a href=\"$file?domain=$fDomain&limit=$tDisplay_next#LowArrow\"><img border=\"0\" src=\"images/arrow-r.png\" title=\"" . $PALANG['pOverview_right_arrow'] . "\" alt=\"" . $PALANG['pOverview_right_arrow'] . "\" /></a>\n";
            }
            print "</div>\n";

            }


        ?>

        </div>
    </div>

<div id="nav_bar">
   <table width=730><colgroup span="1"><col width="550"></col></colgroup>
   <tr><td align=left >
<?php
if ($limit['alias_pgindex_count'] ) print "<b>".$PALANG['pOverview_alias_title']."</b>&nbsp&nbsp";
($tDisplay_back_show == 1) ? $highlight_at = $tDisplay_back / $CONF['page_size'] + 1 : $highlight_at = 0;
$current_limit=$highlight_at * $CONF['page_size'];
for ($i = 0; $i < $limit['alias_pgindex_count']; $i++)
{
   if ( $i == $highlight_at )
   {
      print  "<a href=\"$file?domain=$fDomain&limit=" . $i * $CONF['page_size'] . "\"><b>" . $limit['alias_pgindex'][$i] . "</b></a>\n";
   }
   else
   {
      print  "<a href=\"$file?domain=$fDomain&limit=" . $i * $CONF['page_size'] . "\">" . $limit['alias_pgindex'][$i] . "</a>\n";
   }
}
print "</td><td valign=middle align=right>";

if ($tDisplay_back_show == 1)
{
   print "<a href=\"$file?domain=$fDomain&limit=$tDisplay_back\"><img border=\"0\" src=\"images/arrow-l.png\" title=\"" . $PALANG['pOverview_left_arrow'] . "\" alt=\"" . $PALANG['pOverview_left_arrow'] . "\" /></a>\n";
}
if ($tDisplay_up_show == 1)
{
   print "<a href=\"$file?domain=$fDomain&limit=0\"><img border=\"0\" src=\"images/arrow-u.png\" title=\"" . $PALANG['pOverview_up_arrow'] . "\" alt=\"" . $PALANG['pOverview_up_arrow'] . "\" /></a>\n";
}
if ($tDisplay_next_show == 1)
{
   print "<a href=\"$file?domain=$fDomain&limit=$tDisplay_next\"><img border=\"0\" src=\"images/arrow-r.png\" title=\"" . $PALANG['pOverview_right_arrow'] . "\" alt=\"" . $PALANG['pOverview_right_arrow'] . "\" /></a>\n";
}
print "</td></tr></table></div>\n";


if (boolconf('alias_domain')) {
# XXX: the following block misses one intention level
if ((sizeof ($tAliasDomains) > 0) || (is_array ($tTargetDomain) ))
{
   print "<table id=\"alias_domain_table\">\n";
   print "   <tr>\n";
   print "      <td colspan=\"4\"><h3>" . $PALANG['pOverview_alias_domain_title'] . "</h3></td>";
   print "   </tr>";
   if(sizeof ($tAliasDomains) > 0)
   {
      print "   <tr class=\"header\">\n";
      print "      <td>" . sprintf($PALANG['pOverview_alias_domain_aliases'], $fDomain) . "</td>\n";
      print "      <td>" . $PALANG['pOverview_alias_domain_modified'] . "</td>\n";
      print "      <td>" . $PALANG['pOverview_alias_domain_active'] . "</td>\n";
      print "      <td>&nbsp;</td>\n";
      print "   </tr>\n";
      for ($i = 0; $i < sizeof ($tAliasDomains); $i++)
      {
         print "   <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
         print "      <td><a href=\"$file?domain=" . urlencode ($tAliasDomains[$i]['alias_domain']) . "&limit=" . $current_limit . "\">" . $tAliasDomains[$i]['alias_domain'] . "</a></td>\n";
         print "      <td>" . $tAliasDomains[$i]['modified'] . "</td>\n";
         $active = ($tAliasDomains[$i]['active'] == 1) ? $PALANG['YES'] : $PALANG['NO'];

# TODO: change all edit-*.php scripts not to require the domain parameter (and extract it from the address). This avoids superflous problems when using search.

         print "      <td><a href=\"edit-active.php?alias_domain=true&domain=" . urlencode ($tAliasDomains[$i]['alias_domain']) . "&return=$file" . urlencode ( "?domain=" . $fDomain . "&limit=" . $current_limit) . "\">" . $active . "</a></td>\n";
         print "      <td><a href=\"delete.php?table=alias_domain&delete=" . urlencode ($tAliasDomains[$i]['alias_domain']) . "&domain="
           . urlencode ($tAliasDomains[$i]['alias_domain'])
           . " \"onclick=\"return confirm ('" . $PALANG['confirm'] . $PALANG['pOverview_get_alias_domains'] . ": ". $tAliasDomains[$i]['alias_domain'] . "')\">" . $PALANG['del'] . "</a></td>\n";
         print "   </tr>\n";
      }
   }

   if(is_array($tTargetDomain))
   {
      print "   <tr class=\"header\">\n";
      print "      <td>" . sprintf($PALANG['pOverview_alias_domain_target'], $fDomain) . "</td>\n";
      print "      <td>" . $PALANG['pOverview_alias_domain_modified'] . "</td>\n";
      print "      <td>" . $PALANG['pOverview_alias_domain_active'] . "</td>\n";
      print "      <td>&nbsp;</td>\n";
      print "   </tr>\n";
      print "   <tr class=\"hilightoff\" onMouseOver=\"className='hilighton';\" onMouseOut=\"className='hilightoff';\">\n";
      print "      <td><a href=\"$file?domain=" . urlencode ($tTargetDomain['target_domain']) . "&limit=" . $current_limit . "\">" . $tTargetDomain['target_domain'] . "</a></td>\n";
      print "      <td>" . $tTargetDomain['modified'] . "</td>\n";
      $active = ($tTargetDomain['active'] == 1) ? $PALANG['YES'] : $PALANG['NO'];
      print "      <td><a href=\"edit-active.php?alias_domain=true&domain=" . urlencode ($fDomain) . "&return=$file" . urlencode ( "?domain=" . $fDomain . "&limit=" . $current_limit) . "\">" . $active . "</a></td>\n";
      print "      <td><a href=\"delete.php?table=alias_domain&delete=" . urlencode ($fDomain) . "&domain=" . urlencode ($fDomain) . "\" onclick=\"return confirm ('" . $PALANG['confirm'] . $PALANG['pOverview_get_alias_domains'] . ": " . htmlentities ($fDomain) . "')\">" . $PALANG['del'] . "</a></td>\n";
      print "   </tr>\n";

   }
   print "</table>\n";
}
# XXX: the above block misses one intention level
   if (!is_array($tTargetDomain))
   {
      # TODO: don't print create link if no domains are left for aliasing
      print "<p><a href=\"create-alias-domain.php?target_domain=$fDomain\">" . $PALANG['pMenu_create_alias_domain'] . "</a>\n";
   }
}



?>
</div>