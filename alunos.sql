-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2025 às 19:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `carometro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `turma` varchar(20) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `cpf`, `telefone`, `email`, `turma`, `foto`, `data_cadastro`) VALUES
(1, 'Kauan Duarte Flauzino', '498.472.418-80', '(14) 99875-5587', 'kauanduarteflauzino@gmail.com', 'Idev 2', '682e0c2863109.png', '2025-05-19 18:21:34'),
(2, 'Yasmim Moreno Caveriani', '541.154.468-89', '(14) 99738-9273', 'yasmimmorenocaveriani@gmail.com', 'Idev 2', '682e0c0ec3b77.png', '2025-05-19 18:21:34'),
(3, 'Miguel Rubens de Souza', '482.984.238-52', '(14) 99646-7870', 'miguelrubens2008@gmail.com', 'Idev 3', '682cd91f846a6.png', '2025-05-19 18:21:34'),
(4, 'Otávio Rodrigues Seidinger ', '469.670.208-11', '(14) 99747-0330', 'taloswi@gmail.com', 'Idev 3', '682cd9958e67d.png', '2025-05-19 18:21:34'),
(5, 'Lucas Ferreira', '789.123.456-00', '(11) 96543-2109', 'lucas.ferreira@email.com', 'Idev 4', '682bc6add9b09.png', '2025-05-19 18:21:34'),
(6, 'Julia Pereira', '654.321.987-00', '(11) 98901-2345', 'julia.pereira@email.com', 'Idev 4', '', '2025-05-19 18:21:34'),
(7, 'Pedro Henrique Magalhães dos Santos', '497.839.998-00', '(14) 99898-1701', 'pedrohenrique.msantos.2001@gmail.com', 'Idev 2', '682e0a1bba3a1.png', '2025-05-19 18:31:18'),
(8, 'Arthur Marques Silva Nascimento', '458.606.428-57', '(14) 99879-8292', 'arthur.marques200911@gmail.com', 'Idev 3', '682cd3fb6a040.png', '2025-05-20 00:01:35'),
(9, 'Ana Clara batista Minin', '427.098.938-60', '(18) 99728-2155', 'oijosefa6@gmail.com', 'Idev 3', '682cd3bcabfcc.png', '2025-05-20 19:10:52'),
(10, 'Arthur Passi Dezan', '449.352.198-82', '(14) 99680-1009', 'rthur8622@gmail.com', 'Idev 3', '682cd43436678.png', '2025-05-20 19:12:52'),
(11, 'Beatriz Garrido Rodrigues Siriani', '477.981.748-00', '(14) 99901-2211', 'biasiriani200722@gmail.com', 'Idev 3', '682cd46e49504.png', '2025-05-20 19:13:50'),
(12, 'Carlos Eduardo Martins dos Santos', '571.761.478-09', '(14) 99820-9077', 'carloslevado09@gmail.com', 'Idev 3', '682cd4d670bda.png', '2025-05-20 19:15:34'),
(13, 'Emanuel Henrique Silva Pereira', '512.588.768-41', '(14) 99768-5425', 'emanuelpereirasilvahenrique@gmailcom', 'Idev 3', '682cd52b4dc0b.png', '2025-05-20 19:16:59'),
(14, 'FELIPE ANDRADE OLIVEIRA', '466.339.218-02', '(18) 99764-2034', 'pipocacomsal0102@gmail.com', 'Idev 3', '682cd578f0ec2.png', '2025-05-20 19:18:16'),
(15, 'Felipe Nercelso De Souza Santos', '502.036.388-08', '(14) 98812-9432', 'Detriste2018@gmail.com', 'Idev 3', '682cd5c43dbb7.png', '2025-05-20 19:19:32'),
(16, 'Isabela Neves Longhi', '442.572.398-83', '(14) 99863-6779', 'neveslonghiisabela@gmail.com', 'Idev 3', '682cd60c03cbd.png', '2025-05-20 19:20:44'),
(17, 'João Pedro Alves Rodrigues', '424.265.688-28', '(14) 99863-6779', 'joaopedro222931@gmail.com', 'Idev 3', '682cd674217a1.png', '2025-05-20 19:21:38'),
(18, 'Júlia Carvalho Wada', '451.812.358-16', '(14) 98119-9818', 'juliawadac@gmail.com', 'Idev 3', '682cd6ae7cb6b.png', '2025-05-20 19:23:26'),
(19, 'Júlia Checchio de Lima', '532.465.648-84', '(14) 99783-3767', 'checchiodelimajuli@gmail.com', 'Idev 3', '682cd747af200.png', '2025-05-20 19:25:59'),
(20, 'Lucas Gregorio Santos', '500.677.498-36', '(14) 99600-2734', 'lucas.gregorio.lgs@gmail.com', 'Idev 3', '682cd78566b8b.png', '2025-05-20 19:27:01'),
(21, 'Lívia Sayuri Shiro Targino', '538.257.098-17', '(14) 99688-5995', 'liviasayurishirotargino@gmail.com', 'Idev 3', '682cd7c81749c.png', '2025-05-20 19:28:08'),
(22, 'Leonardo Marconi Marcheti', '418.018.558-03', '(14) 99740-6245', 'leonardomarcheti2@gmail.com', 'Idev 3', '682cd7f5449b9.png', '2025-05-20 19:28:53'),
(23, 'Lohanny Pereira Miranda', '466.578.338-14', '(14) 99196-6398', 'lohannypmiranda@gmail.com', 'Idev 3', '682cd8404387e.png', '2025-05-20 19:30:08'),
(24, 'Maria Eduarda Santos Oliveira', '493.550.998-86', '(14) 99902-0318', 'mesoliveira.1977@gmail.com', 'Idev 3', '682cd899b76ec.png', '2025-05-20 19:31:37'),
(25, 'Miguel dos Santos Pereira', '420.786.268-48', '(14) 99705-2890', 'mp254914@gmail.com', 'Idev 3', '682cd8dd628b5.png', '2025-05-20 19:32:45'),
(26, 'Nicolas Freitas de Souza', '414.472.678-93', '(14) 99902-0608', 'nicolas.desouza02062008@gmail.com', 'Idev 3', '682cd95aacf97.png', '2025-05-20 19:34:50'),
(27, 'Otávio Yuuki Kashima', '438.798.758-80', '(14) 99767-9302', 'otaviokashima@gmail.com', 'Idev 3', '682cd9df0128c.png', '2025-05-20 19:37:03'),
(28, 'Luiz Miguel Barbosa de Souza Boas', '121.663.619-27', '(14) 98170-3578', 'luizmboas@gmail.com', 'Idev 3', '682cda38ef88a.png', '2025-05-20 19:38:32'),
(29, 'Rafael Ceolin Vieira', '533.812.928-03', '(14) 99713-0692', 'rafaelcevieira8@gmail.com', 'Idev 3', '682cda69b44bc.png', '2025-05-20 19:39:21'),
(30, 'Rafael Sanches Peracine ', '449.122.048-46', '(14) 99770-2009', 'rafaelsanchesperacine@gmail.com', 'Idev 3', '682cdaa460e19.png', '2025-05-20 19:40:20'),
(31, 'Sarah Santana de Jesus', '415.087.018-73', '(14) 99602-6090', 'sarah.sjesus1702@gmail.com', 'Idev 3', '682cdae2b4cfa.png', '2025-05-20 19:41:22'),
(32, 'Brian Shinhama Belo da Silva', '236.540.888-56', '(14) 99904-5744', 'brianshinhama@gmail.com', 'Idev 3', '682cdb0f02c7c.png', '2025-05-20 19:42:07'),
(33, 'Sofia Morilha Dantas', '507.274.468-00', '(14) 99879-1338', 'dantassofia84@gmail.com', 'Idev 3', '682cdb5812ff8.png', '2025-05-20 19:43:20'),
(34, 'Thalisson Douglas Pereira de Lima', '605.725.768-54', '(18) 99813-6873', 'thalissondouglas86@gmail.com', 'Idev 3', '682cdba1bb687.png', '2025-05-20 19:44:33'),
(35, 'Thiago Augusto de Paula Silva', '244.532.898-55', '(14) 99707-3664', 'thiagoaugusto142202@gmail.com', 'Idev 3', '682cdbefc558a.png', '2025-05-20 19:45:51'),
(36, 'Mariana Ferreira Gomes', '437.290.688-90', '(14) 99696-0053', 'whois.mari.work@gmail.com', 'Idev 3', '682e01cf29a03.png', '2025-05-21 16:39:43'),
(37, 'Alexandre Magalhães Deboletta', '400.087.478-06', '(14) 99853-7064', 'alexandredeboletta@gmail.com', 'Idev 2', '682e038a6f892.png', '2025-05-21 16:47:06'),
(38, 'Camilly Bianca de Moraes Reis ', '473.794.958-28', '(14) 99861-0057', 'camillybiancamr@gmail.com', 'Idev 2', '682e03ea7d96c.png', '2025-05-21 16:48:42'),
(39, 'Carolina Romano Teixeira', '516.981.668-50', '(14) 99645-8546', 'carol.teixeira351@gmail.com', 'Idev 2', '682e0433884ad.png', '2025-05-21 16:49:55'),
(40, 'Claudete Carmo Machado', '541.954.308-79', '(14) 99905-2372', 'claudetemachado692@gmail.com', 'Idev 2', '682e0471b35b4.png', '2025-05-21 16:50:57'),
(41, 'Eduarda Rodrigues Monteiro', '445.939.948-29', '(14) 99861-0352', 'eduardarodriguesmonteiro76@gmail.com', 'Idev 2', '682e04b39b24f.png', '2025-05-21 16:52:03'),
(42, 'Enzo Rafael Domingues Bussi', '535.789.908-84', '(14) 99845-6671', 'enzobussi3103@gmail.com', 'Idev 2', '682e04efb1a41.png', '2025-05-21 16:53:03'),
(43, 'Felipe Augusto Santos Da Silva', '489.380.888-55', '(14) 99792-6595', 'flpgstsilva@gmail.com', 'Idev 2', '682e05368dd47.png', '2025-05-21 16:54:14'),
(44, 'Felipe Loncarovich dos Santos', '547.168.118-59', '(14) 99740-2855', 'felipeloncarovichdossantos@gmail.com', 'Idev 2', '682e05728cd3a.png', '2025-05-21 16:55:14'),
(45, 'Gabriel de Oliveira Rodrigues', '567.171.938-08', '(14) 98809-2731', 'bielolirodrigues@gmail.com', 'Idev 2', '682e05ad68bdf.png', '2025-05-21 16:56:13'),
(46, 'Gabriel de Souza Neto Pires', '403.911.498-14', '(14) 99705-6541', 'gabri4590@gmail.com', 'Idev 2', '682e2ca73b62c.png', '2025-05-21 16:57:25'),
(47, 'Gabrielle de Lima Quinquio', '545.709.658-06', '(14) 99828-8199', 'gabrielledelimaq@gmail.com', 'Idev 2', '682e064b58517.png', '2025-05-21 16:58:51'),
(48, 'Giovani Canella de Souza', '488.169.508-89', '(14) 99690-1150', 'giovanicanellaoficial2@gmail.com', 'Idev 2', '682e068e9bf72.png', '2025-05-21 16:59:58'),
(49, 'Guilherme de Souza Trevisan', '541.962.938-08', '(14) 99713-4530', 'souzagui2t@gmail.com', 'Idev 2', '682e06c018420.png', '2025-05-21 17:00:48'),
(50, 'Guilherme Ferraresi Dallacqua', '534.467.958-04', '(14) 99907-5800', 'guilhermeferraresidallacqua405@gmail.com', 'Idev 2', '682e0708da3ee.png', '2025-05-21 17:02:00'),
(51, 'Henry Gabriel Rodrigues Barbosa', '496.013.068-70', '(14) 99719-7600', 'henrygabrielrb2@gmail.com', 'Idev 2', '682e079791f01.png', '2025-05-21 17:04:23'),
(52, 'Isabela Cunha Manzano', '446.155.038-90', '(14) 99861-7770', 'isabelacmanzano05@gmail.com', 'Idev 2', '682e07c97b490.png', '2025-05-21 17:05:13'),
(53, 'Jhuan Medeiros Cordeiro', '541.047.218-75', '(14) 98117-2062', 'jhuan.mcordeiro@gmail.com', 'Idev 2', '682e0820a6a2b.png', '2025-05-21 17:06:40'),
(54, 'Juan Miguel Mauro Rodriges', '479.891.138-05', '(14) 98808-2795', 'juanxadez2@gmail.com', 'Idev 2', '682e08c745d95.png', '2025-05-21 17:09:27'),
(55, 'Lucas Dias Letzel', '489.794.528-37', '(14) 99803-0154', 'lucasdiasletzel@gmail.com', 'Idev 2', '682e090ecdae3.png', '2025-05-21 17:10:38'),
(56, 'Lucas Martins Alves', '410.110.548-09', '(14) 99878-2220', 'lucasalvesmartinns@gmail.com', 'Idev 2', '682e0951abde4.png', '2025-05-21 17:11:45'),
(57, 'Mateus Silverio de Oliveira', '441.284.498-65', '(19) 98996-1739', 'mateussilverio855@gmail.com', 'Idev 2', '682e09955e895.png', '2025-05-21 17:12:53'),
(58, 'Matheus Rodolpho de Almeida', '480.888.758-46', '(14) 99900-3232', 'matheus.rodolpho16@gmail.com', 'Idev 2', '682e09c7b00aa.png', '2025-05-21 17:13:43'),
(59, 'Vitória Muniz de Souza', '529.965.968-70', '(14) 99854-5353', 'vitoriamuniz0507@gmail.com', 'Idev 2', '682e0a5d18248.png', '2025-05-21 17:16:13'),
(60, 'Vinicius Lima Sulpicio', '444.835.858-51', '(14) 99690-7398', 'viniciusulpicio@gmail.com', 'Idev 2', '682e0a9802c38.png', '2025-05-21 17:17:12'),
(61, 'Pedro Gabriel Ribeiro Lima', '503.043.468-29', '(14) 99840-2416', 'gabrielribeirolimapedro@gmail.com', 'Idev 2', '682e0b08a8665.png', '2025-05-21 17:19:04'),
(62, 'Tomás Heizo Domingues Yamakawa', '475.759.468-29', '(14) 99816-2364', 'tomasdomingues51@gmail.com', 'Idev 2', '682e0b7062bbc.png', '2025-05-21 17:20:48'),
(63, 'ffda', '342.542.343-43', '(32) 5235-25', 'luciano.trambaiolli@gmail.com', 'Idev 4', '6839e8e8310d3.png', '2025-05-30 17:20:40');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
