
--
-- Estrutura para tabela `parcelas_contas_clientes`
--

CREATE TABLE `parcelas_contas_clientes` (
  `id` int(11) NOT NULL,
  `id_venda` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `vencimento` date NOT NULL,
  `data_pgto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `parcelas_contas_clientes`
--
ALTER TABLE `parcelas_contas_clientes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `parcelas_contas_clientes`
--
ALTER TABLE `parcelas_contas_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;