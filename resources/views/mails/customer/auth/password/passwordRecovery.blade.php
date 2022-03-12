<div>
    <h3>Tripler</h3>
    <hr />
    <p>
        Olá, <strong>{{ $customer->name }}</strong><br />
        Você solicitou uma recuperação de senha, clique no botão abaixo para poder redefinir sua senha.
    </p>
    <a style="background:#7c00ff;
    padding: .8em;
    color:#fff;
    display: inline-block;
    text-decoration: none;
    border-radius:6px;" target="_blank" href={{ $link }}>Redefinir Senha</a>
</div>
