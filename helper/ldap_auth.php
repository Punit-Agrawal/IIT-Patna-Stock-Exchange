<?php
function authorize($username, $password) {
	$log = Logger::getLogger ( "AccessLogger" );
	
	$log->trace ( "{$_SESSION['user_name']}#ldap Trying#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['user_type']}" );
	
	$server = ldap_connect ( "172.16.1.160" );
	if ($server) {
		ldap_set_option ( $server, LDAP_OPT_PROTOCOL_VERSION, 3 );

		$result = ldap_search ( $server, "dc=iitp,dc=ac,dc=in", "uid={$username}" );
		$count=ldap_count_entries($server,$result);
		if ($count!=0){
			$info = ldap_get_entries ( $server, $result );
			$ldaprdn = $info [0] ['dn'];
			$log->trace ( "{$_SESSION['user_name']}#ldap entry found uid={$username}#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['user_type']}" );
		}
		else{
			$result = ldap_search ( $server, "dc=iitp,dc=ac,dc=in", "cn={$username}" );
			$count=ldap_count_entries($server,$result);
			if ($count!=0){
				$info = ldap_get_entries ( $server, $result );
				$ldaprdn = $info [0] ['dn'];
				$log->trace ( "{$_SESSION['user_name']}#ldap entry found cn={$username}#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['user_type']}" );
			}
			else{
				$ldaprdn = 'none';
				$log->trace ( "{$_SESSION['user_name']}#ldap entry not found#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['user_type']}" );
				return false;
			}
		}
		
		
		$binder = ldap_bind ( $server, $ldaprdn, $password );
		if ($binder) {
			$log->trace ( "{$_SESSION['user_name']}#ldap Success#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['user_type']}" );
			return true;
		} else {
			$log->trace ( "{$_SESSION['user_name']}#ldap failiure#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['user_type']}" );
			return false;
		}
	}
	$log->trace ( "{$_SESSION['user_name']}#ldap Down#{$_SERVER['REMOTE_ADDR']}#{$_SESSION['user_type']}" );
	return false;
}
?>
