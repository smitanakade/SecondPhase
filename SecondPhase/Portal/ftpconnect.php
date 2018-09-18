<?php 
/* if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");               

$conn = ssh2_connect('52.65.147.55', '');
echo $conn;
ssh2_auth_pubkey_file($conn,'myeracademy','/var/www/html/Portal/recordneeded.pem');

// send a file
ssh2_scp_send($conn, '/var/www/html/FILETOSEND.TXT', 'FILETOSEND.TXT', 0644); */
?>

<?php
$conn = ssh2_connect('example.com', 22);
	ssh2_auth_password($conn, 'username', '-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEA5Iy3eNnU5lMCGV4mAH1E6zvXdL7q0xrZb7NItyMb5vXJq6bY
6UOU0k89kAOsy/zsVLFgj3guywOJyPC4eAZDeiBhYNTbml9dCrpSehIGcSM3U1zW
W0mctMD4pU/blQN9I3Jk33ma/fkuPO9sjM3Bt2VoHPhLam+vDSgT8NTCWMSXJVfr
XQduNB9lsb9DNhZ3jP6hXPdlC2aTC0mSHlXJPgRHwuZfESoHKtmXFfvYCTt4YQcD
8Z/n8DUZAjhHQAIPzNLjbUf1vqeFqgjMIbn+hsKjIqvwdeIuEV3BSJPJuQHB9Sf2
T4VrM9HoiF81yUkDUJgs85iniLl5jiXxTD/bPQIDAQABAoIBAQCoVz2MtmYqgFm7
da1oDt0Epz87rqQoek5OCDA3NJUIuWGiHXMH3c9wWQ1vVkWgutsYRs5o3o0Y27JR
X32AapypB9CyEhbuze8qR7MYVs6H5viJXohFFSNnv/tlSDzktX0m7st+D4QqLa/x
EilSTPuyqe7V580kyL6XYj3N1eiQmFih7xkVySdJlEUIlnTQ9DlWgAJTfukbvE41
G/0KgQWY+IWf0JFtiBhyXnS/YjVVboqPgO7gCprvH2MTNFkYFkMQ5hACHjwi2lMD
vDGOQ+5pvrV62MPgtUf/mkH9hect7wjoyZ/Gvsu/oFxe44B6GxKcOtBCNayvTUqm
fI0DNvXBAoGBAPRudeYnG/G8Ttd5ACxdHGXIH0crQFGKf30nDalCZ0z9b1sMMmUm
6M6pCPvUZuhKR761HhcQKrKev0WkLX8E8R5MonBLIbKaHG3nOzUMQ1PM/RvEUJ+w
Dk8CPfDRdyAkrA5/A54U/53k1TVKZV2ebXArBZoXynoOy7ksrARjeT7/AoGBAO9d
1OUGj2/Pfal52ivET0ql78RTetlSttYo6RUIZ5HAduTyqTGA5v2mGFqcKtiKaGXD
RKjS5dWNkOHHTgFFQHyJOFYSCWvzdt3m3p4SNcW4mVMiNKEppoOP6xzKkKF/g1C8
jl1nE+qtBjmRTUH9vWJ80Ijcn1hM52tsYlFgOiHDAoGBAO7+XjrF/JW06GXYQqod
9Fk0fhipGn9f6t2k5L+dVMG7fzjHyTKMA8+lCUqp2GDB2DqIfr5QKV9yxlRCfdWX
MGbOyXkAjRdDhg6Tq5lnvyDd6pFOtwIcMzFfYM7pEBAWq0CVQiU8JN7uUuWDM2+B
K0IkXprXLjt/4gPRwPOdi3xjAoGAFCZ0/pavynzQGk08tYSAHEudxIw2gkb5R0wI
WxHrDhUCrUFURuuQBnhOAoq0/KeiJDbs971RRcn2EVui0G6RACrZCD3adzD2p7WA
thPYXP2uQpZVkd+cueSKqVDQHhhK6KgG4AwGXDIWnRADTfPbVoglUfAopdlLffqQ
yELugdsCgYEAn+0f9se1XWnosZULSnBehfNFHKEeohO9Iqw51XSS+hegpLeZOiEN
H4NyOH9LY9eootxInt8E74JpVArxnXHXw7YZqnNnS6GkFoGUCuuv5isEJMg+5mlM
N7Z3wlUojI2JxXa7nIMibYx2mYsDNazUPLza7BikeEm8jMUjEu+htZA=
-----END RSA PRIVATE KEY-----');
	$conn = ssh2_connect('example.com', 22);
	ssh2_auth_pubkey_file(
	    $conn,
	    'username',
	    '/home/username/.ssh/id_rsa.pub',
        '/home/username/.ssh/id_rsa'
        );
        ?>