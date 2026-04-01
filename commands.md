git add .
git commit -m "mensagem"
git push

cat > COMMANDS.md << 'EOF'
# Comandos úteis do projeto

## Servidor
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## Banco de dados
```bash
php artisan migrate          # Rodar migrations
php artisan migrate:fresh    # Recriar banco do zero
php artisan migrate:rollback # Reverter última migration
php artisan db:seed          # Rodar seeders
```

## Artisan
```bash
php artisan make:model NomeModel -m    # Model + migration
php artisan make:controller NomeController
php artisan make:migration nome_migration
php artisan make:seeder NomeSeeder
php artisan route:list                 # Listar rotas
php artisan tinker                     # Console interativo
```

## Assets
```bash
npm run dev    # Desenvolvimento
npm run build  # Produção
```

## Composer
```bash
composer install         # Instalar dependências
composer require pacote  # Adicionar pacote
EOF
```

Depois é só fazer o commit:
```bash
git add COMMANDS.md
git commit -m "add: comandos úteis"
git push
```

