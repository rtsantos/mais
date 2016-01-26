<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 */

class ZendT_Grid implements ZendT_JS_Interface {

    /**
     * Permite setar as configurações globais de ajax do grid
     * que o grid usa enquanto requisita os dados
     * 
     * Importante notar que com essa opção é possivel sobreescrever todas as configurações
     * de ajax correntes, como: error, complete e beforeSend.
     * 
     *
     * @var type object
     * @default empty object
     * @editable true
     */
    private $_ajaxGridOptions = null;

    /**
     * Permite setar as configurações globais de ajax para o evento select.
     * quando a seleção é obtida via as opções de dataUrl em editoptions ou searchoptions objects
     * 
     * 
     * @var type object
     * @default empty object
     * @editable true
     */
    private $_ajaxSelectOptions = null;

    /**
     * Parâmetro usado para criar zebra dos registros listados na grid
     * Você consegue construir sua própria classe sobreescrevendo este valor
     * 
     * É possível alterar esta opção, requer refresh
     * 
     * 
     * @var type string
     * @default ui-priority-secondary
     * @editable true
     */
    private $_altclass;

    /**
     * Habilita o efeito zebra nos registros do grid
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_altRows;

    /**
     * Quando está setada como true, converte tags htmls
     * exemplo: < para &lt;
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_autoencode;

    /**
     * Quando setado como true, a largura do grid
     * é recalculada automaticamente de acordo com seu pai no DOM.
     * Só é possível setar um valor a esta opção quando o grid é criado
     * através do método setGridWidth
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_autowidth;

    /**
     * Camada da legenda do grid aparecendo acima da camada do cabeçalho
     * Estando vazio o parâmetro não aparecerá nada
     * 
     * @var type string
     * @default empty string
     * @editable false
     */
    private $_caption;

    /**
     * Determinada o espaçamento e a largura da borda das células da tabela
     * O recomendado é não mudar, mas caso você queira customizar
     * as alterações do <td> precisam ser feitas no arquivo css
     * 
     * O valor inicial 5 significa padding: 0 2px 0 2px, border-left: 1px
     * 
     * @var type integer
     * @default 5
     * @editable false
     */
    private $_cellLayout;

    /**
     * Habilita a edição da célula
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_cellEdit;

    /**
     * Determina o local onde o conteúdo da célula editada será salvo
     * remotamente ou em um array
     *
     * @var type string
     * @default 'remote'
     * @editable true
     */
    private $_cellsubmit;

    /**
     * Url onde as células são salvas
     * 
     * @var type string
     * @default null
     * @editable true 
     */
    private $_cellurl;

    /**
     * Define o conjunto de propriedades que sobreescreverão os valores
     * default do modelo de coluna. Por exemplo:
     * Se você quiser fazer todas as colunas não classificáveis
     * você pode seta apenas uma propriedade em vez de em todas as colunas
     * 
     * 
     * @var type object
     * @default null
     * @editable false
     */
    private $_cmTemplate;

    /**
     * Descreve os parâmetros das colunas.
     * Parte muito importante no grid. Para uma descrição completa de todos os valores
     * veja a colModel API
     * which describes the parameters of the columns.This is the most important part of the grid. For a full description of all valid values see colModel API.
     * 
     * @var type \ZendT_Grid_Property_ColModel
     * @default empty array
     * @editable false 
     */
    private $_colModel;

    /**
     * Uma array que contém os nomes das colunas separados por vírgulas
     * O texto aparece no cabeçalho da coluna
     * O número de elementos dentro desse array deve ser igual ao do número de elementos no
     * parâmetro colModel
     * 
     * @var type array
     * @default empty array
     * @editable false
     */
    private $_colNames;

    /**
     * Array que armazena os dados exibidos na grid
     * Você pode apontar diretamente para essa variável se caso você queria carregar dados
     * providos de um array, conseguindo sobreescrever o método addRowData que é lento
     * em relação a grandes quantidades de informações     * 
     * 
     * @var type array
     * @default null
     * @editable true
     */
    private $_data;

    /**
     * A string dos dados quando o datatype é setado como xmlstring ou jsonstring
     * 
     * @var type string
     * @default null
     * @editable true
     */
    private $_datastr;

    /**
     * Define qual o tipo da informação que o grid irá ler
     * As opções válidas são:
     *                          xml => xml object,
     *                          xmlstring => xml como string,
     *                          json => json object,
     *                          jsonstring => json como string,
     *                          local => array definido no código javascript
     *                          javascript => javascript object
     *                          function => função definida para recuperar dados, veja em colModel API e Retrieving Data
     * 
     * @var type string
     * @default xml
     * @editable true
     */
    private $_datatype;

    /**
     * Essa opção deve ser setada como true se um evento ou plugin for anexado as células da tabela
     * Ela remove todos os outros eventos nativos da linha e de todos os seus filhos
     * Há um problema de sobrecarga, mas ela evita um estouro de memória.
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_deepempty;

    /**
     * Aplicado e utilizável somente quando o datatype é local
     * Remove a seleção após a reordenação dos registros
     * 
     * @var type boolean
     * @default true
     * @editable true
     */
    private $_deselectAfterSort;

    /**
     * Determina a direção do texto dentro das células
     * O valor 'rtl' não é suportada no Google Chrome, só Opera, Firefox 3.x, IE 6, ou versões maiores suportam totalmente esta opção
     * 
     * @var type string
     * @default ltr
     * @editable false
     */
    private $_direction;

    /**
     * Define a url para edição inline dos dados no grid
     * 
     * @var type string
     * @default null
     * @editable true
     */
    private $_editurl;

    /**
     * Somente válido se viewrecords estiver como true
     * Mostra uma informção quando número de retornado ou atual de registros é zero
     * 
     * 
     * @var type string
     * @default 'see lang file'
     * @editable true
     */
    private $_emptyrecords;

    /**
     * Quando está true o treeGrid é expandido ou fechado quando
     * nós clicamos no texto da coluna expandida não somente na imagem
     * 
     * @var type boolean
     * @default true
     * @editable false
     */
    private $_ExpandColClick;

    /**
     * Indica cada coluna tendo como base o colModel.
     * Deve ser usado para expandir o tree grid
     * Válido somente quando treeGrid estiver habilitado ( true )
     *
     * @var type string
     * @default null
     * @editable false
     */
    private $_ExpandColumn;

    /**
     * Se for setado true no valor desta propriedade
     * um rodapé entre os registros e a paginação será criado
     * O número de colunas é igual ao número de colModel
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_footerrow;

    /**
     * Se true, e há um redimensionamento em uma coluna em sua largura
     * a largura da coluna do lado direito desta é alterada mantendo o tamanho de largura inicial do grid.
     * 
     * Esta opção não é compatível com shrinkToFit
     * No I.E o shrinkToFit é falso e forceFit é ignorado
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_forceFit;

    /**
     * Determina o estado do grid ( I.E quando usado com hiddengrid, hidegrid e caption)
     * Há a existência de dois estados 'visible' ou 'hidden'
     * 
     * @var type string
     * @default 'visible'
     * @editable false
     */
    private $_gridstate;

    /**
     * Versões anteriores eu conseguia visualizar mais de 100 linhas por página causando problemas de desempenho
     * A razão para isto é que, como cada célula foi inserido no grade aplicou-se cerca de 5-6 chamadas jQuery para ele.
     * Agora este problema está resolvido, temos agora inserir a linha de entrada de uma só vez com um append jQuery.
     * O resultado é impressionante - cerca de 3-5 vezes mais rápido. Qual será o resultado se inserir todos os dados de uma só vez?
     * Sim, isso pode ser feito com a ajuda de opção gridview quando definido como true.
     * O resultado é uma grade que é de 5 a 10 vezes mais rápido. É claro que quando esta opção é definida como true temos algumas limitações.
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_gridview;

    /**
     * Habilita agrupamento no grid. Veja referências na página de grupos
     * Enables grouping in grid. Please refer grouping page.
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_grouping;

    /**
     * Se for setado true para esta opção o valor do atributo título
     * é adicionado a coluna dos cabeçalhos
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_headertitles;
    
    /**
     * Se for setado true para esta opção possibilitará a adição de mais uma linha de header na grid
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_groupHeaders;
    
    /**
     * Determina se a tabela do groupHeader terá ColSpan quando existir
     * 
     * @var type boolean
     * @default false
     */
    private $_useColSpanStyle;

    /**
     * A altura do grid
     * Pode ser setado com númer unidade de medida é pixel
     * Para medição em porcentagem basta colocar % após o número
     * Ou 'auto' como valor
     * 
     * @var type mixed
     * @default 150
     * @editable false
     */
    private $_height;

    /**
     * Se estiver setado como true o grid iniciará hidden
     * os dados não serão carregados e somente a legenda será exibida
     * Quando o botão de exibir ou esconder é clicado o grid é exibido e acontece a requisição para recuperar os dados
     * e o grid é exibido, tendo um grid normal.
     * Essa opção só terá efeito se a legenda não estiver vazia e a propriedade hidegrid estiver como true
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_hiddengrid;

    /**
     * Habilita ou desabilita o botão para exibição do grid
     * Que aparece do lado da camada de legenda
     * Só é funcional se a propriedade caption não estiver vazia
     * 
     * @var type boolean
     * @default true
     * @editable false
     */
    private $_hidegrid;

    /**
     * Quando é setado como falso o hover do mouse é desabilitado sobre as linhas do grid
     * 
     * @var type boolean
     * @default true
     * @editable true
     */
    private $_hoverrows;

    /**
     * Recebe o html necessário para renderização do grid de acordo
     * com as propriedades setadas na instanciação desta classe
     * 
     * @var type string
     */
    private $_html;

    /**
     * Quando essa string é setada, é adicionado um prefixo no id da linha quando
     * o grid é construido
     *
     * @var type string
     * @default empty
     * @editable true
     */
    private $_idPrefix;

    /**
     * A busca por default é case sensitive, para torná-la case insensitive tanto a busca
     * quanto a ordenação sete true nesta propriedade
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_ignoreCase;

    /**
     * Array usado para armazenar os dados futuramente postados para o servidor
     * quando estamos em uma edição inline
     * 
     * @var type object
     * @default {}
     * @editable true
     */
    private $_inlineData;

    /**
     * Array que descreve a estrutura de esperados dados de json.
     * Veja Retrieving Data JSON Data para saber sobre as configurações padrões e uma total descrição do JSON Data
     * 
     * @var type array
     * @default ''
     * @editable false
     */
    private $_jsonReader;

    /**
     * Recebe o js configurado de acordo com as propriedades setadas na
     * instanciação desta classe
     *
     * @var type string
     */
    private $_js;

    /**
     * Somente leitura.
     * Determina o total de número de páginas de uma requisição
     * 
     * @var type integer
     * @default 0
     * @editable false
     */
    private $_lastpage;

    /**
     * Somente leitura.
     * Determina o índice da última coluna ordenada começando de 0
     * 
     * @var type integer
     * @default 0
     * @editable false
     */
    private $_lastsort;

    /**
     * Se for setado true ao valor desta propriedade, o grid carrega apenas uma vez
     * os dados do servidor (de acordo com o datatype)
     * 
     * Após isso toda manipulação de dados resgatados é feita no lado cliente, não haverá mais requisição cliente-servidor
     * Se houver paginação a mesma será desabilitada.
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_loadonce;

    /**
     * Texto visualizado a cada dado requisitado
     * Este parâmetro está localizado no arquivo de idiomas
     * 
     * @var type string
     * @default Loading...
     * @editable false
     */
    private $_loadtext;

    /**
     * Controle de opções a serem realizadas enquando
     * uma requisição ajax está em progresso
     * 
     * 
     * disable - Desabilita o indicador de progresso, com isso você consegue criar
     *           o seu indicador.
     * 
     * enable - Habilita como default o 'Loading' no centro do grid
     * 
     * block - Habilita o 'Loading' e bloqueia todas as ações do bloco grid, até que
     *         a requisição ajax termine.
     *         Desabilita paginação, ordenação e todas as ações da toolbar
     * 
     * @var type string
     * @default enable
     * @editable true
     */
    private $_loadui;

    /**
     * Define o tipo de requisição realizada POST ou GET
     * 
     * @var type string
     * @default GET
     * @editable true
     */
    private $_mtype;

    /**
     * Este parâmetro só tem sentido se multiselect estiver setado como true.
     * Define a chave que será pressionada quando realizamos multiseleção
     * Os possíveis valores são:
     * - shiftKey - o usuário deve pressionar o Shift
     * - altKey - o usuário deve pressionar o Alt
     * - ctrlKey - o usuário deve pressionar o Ctrl
     * 
     * @var type string
     * @default empty string
     * @editable true
     */
    private $_multikey;

    /**
     * Opção tem valor e funcionalidade quando multiselect está setado como true
     * Clicando em qualquer lugar da linha de registro quando essa propriedade está como true
     * a multiseleção não é feita, neste caso ela só será feita quando clicando no checkbox.
     * Clicando em qualquer outro lugar com o checkbox estiver selecionado haverá um uncheck de todos selecionados
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_multiboxonly;

    /**
     * Se estiver setado como true, a multiseleção das linhas é habilitada
     * e uma nova coluna na esquerda é adicionada. Utilizado com qualquer tipo de datatype
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_multiselect;

    /**
     * Determina a largura da coluna dos checkboxs implementados para multiseleção
     * 
     * @var type integer
     * @default 20
     * @editable false
     */
    private $_multiselectWidth;

    /**
     * Recebe como valor o navigator
     * do grid em questão
     * 
     * @var type \ZendT_Grid_Navigator
     */
    private $_navigator;

    /**
     * Seta o número inicial de páginas quando fazemos uma requisição
     * Este parâmetro é passado para o servidor para uso em uma rotina de resgate de dados
     * 
     * @var type integer
     * @default 1
     * @editable true
     */
    private $_page;

    /**
     * Define que nós queremos usar o paginador para navegação através dos registros
     * Isto deve ser um elemento html válido
     * 
     * No nosso exemplo nós passamos uma div com o id 'pager', mas qualquer nome é aceitável.
     * Note que a camada de navegação consegue ser posicionada em qualquer outro lugar que quisermos
     * Determinado pelo seu html, no nosso exemplo, espeficicamos que a página aparecerá depois da camada do
     * corpo do grid
     * 
     * Chamadas válidas são ( usando o exempl ) 'pager', '#pager', jQuery('#pager')
     * Eu recomendo usar o segundo.
     * Veja Pager
     * 
     * Possível usar somente quando barra de paginação estiver ativa
     * 
     * @var type mixed
     * @default empty string
     * @editable false
     */
    private $_pager;

    /**
     * Determina a posição do paginador no grid
     * O padrão é que o paginador quando criado seja dividido em 3 partes:
     * 1 - Para o paginador
     * 2 - Para os botões de paginação
     * 3 - Para as informações dos registros
     * 
     * @var type string
     * @default center
     * @editable false
     */
    private $_pagerpos;

    /**
     * Determina se os botões da página devem ser exibidos se o paginador é habilitado
     * Também é somente válido se o paginador é setado corretamente
     * Os botões são inseridos na barra de paginação
     * 
     * @var type boolean
     * @default true
     * @editable false
     */
    private $_pgbuttons;

    /**
     * Determina se o input box, onde o usuário consegue mudar o números de páginas requisitadas deve ser
     * habilitado.
     * 
     * O input box aparece na barra de paginação
     * 
     * @var type boolean
     * @default true
     * @editable false
     */
    private $_pginput;

    /**
     * Mostra informações sobre o status da página em evidência.
     * O primeiro valor é a página corrent carregada
     * O segundo valor é o número total de páginas
     * 
     * @var type string
     * @default 
     * @editable true
     */
    private $_pgtext;

    /**
     * Customiza nome de campos e envia ao servidor com POST.
     * Por exemplo: com essa propriedade setada, você consegue mudar a ordem do elemento
     * de sidx para mysort prmNames: {sort: “mysort”}.
     * A string que será postada ao server terá uma url como:
     *  - myurl.php?page=1&rows=10&mysort=myindex&sord=asc rather than myurl.php?page=1&rows=10&sidx=myindex&sord=asc
     * 
     * Quando algum parâmetro é setada nulo, eles não são enviados ao servidor.
     * Por exemplo: prmNames { nd:null }, o parâmetro nd não é enviado.
     * Veja abaixo o significado de cada opção
     * page - a página requisitada - default: page,
     * rows - o número de linhas requisitadas - default: rows,
     * sort - A ordenação das colunas - default: sidx,
     * order - A forma de ordenação - default: sord,
     * search - Indicador de busca - default: _search,
     * nd - O tempo passado para requisição (para os IE não ha cache de requisição) - default: nd,
     * id - O nome do id quando os dados do post estão no módulo de edição - default: id,
     * oper - O parâmetro de operação - default: oper,
     * editoper - O nome da operação quando os dados são postados pelo modo de edição - default: edit,
     * addoper - O nomem da operação quando os dados são postados pelo modo de adição - default: add,
     * deloper - O nomem da operação quando os dados são postados pelo modo de remoção - default: del
     * totalrows - O nome do total de linhas obtidas do servidor - veja rowTotal - default: totalrows
     * subgridid - O nome passado quando nós clicamos para carregar um subgrid - default: id
     * 
     * @var type array
     * @default {page:“page”,rows:“rows”, sort: “sidx”, order: “sord”, search:“_search”, nd:“nd”, id:“id”, oper:“oper”, editoper:“edit”, addoper:“add”, deloper:“del”, subgridid:“id”, npage: null, totalrows:“totalrows”}
     * @editable true
     * 
     */
    private $_prmNames;

    /**
     * Este array associativo é passado diretamente por url
     * veja os métodos da API para manipulação
     * Exe: { name:name... }
     * 
     * @var type array
     * @default empty array
     * @editable true
     */
    private $_postData;

    /**
     * @var type
     * @default
     * @editable
     * integer	Readonly property. Determines the exactly number of rows in the grid. Do not mix this with records parameter. Instead that in most cases they are equal there is a case where this is not true. By example you define rowNum parameter 15, but you return from server records parameter = 20, then the records parameter will be 20, the reccount parameter will be 15, and in the grid you will have 15 records.	0	No
     */
    private $_reccount;

    /**
     * @var type
     * @default
     * @editable
     * string	Determines the position of the record information in the pager. Can be left, center, right	right	No
     */
    private $_recordpos;

    /**
     * @var type
     * @default
     * @editable
     * integer	Readonly property. Determines the number of returned records in grid from the request	none	No
     */
    private $_records;

    /**
     * @var type
     * @default
     * @editable
     * string	Represent information that can be shown in the pager. Also this option is valid if viewrecords option is set to true. This text appear only if the tottal number of recreds is greater then zero.In order to show or hide some information the items in {} mean the following: {0} the start position of the records depending on page number and number of requested records; {1} - the end position {2} - total records returned from the data	see lang file	Yes
     */
    private $_recordtext;

    /**
     * @var type
     * @default
     * @editable
     * string	Assigns a class to columns that are resizable so that we can show a resize handle only for ones that are resizable	empty string	No
     */
    private $_resizeclass;

    /**
     * @var type
     * @default
     * @editable
     * array[]	An array to construct a select box element in the pager in which we can change the number of the visible rows. When changed during the execution, this parameter replaces the rowNum parameter that is passed to the url. If the array is empty the element does not appear in the pager. Typical you can set this like [10,20,30]. If the rowNum parameter is set to 30 then the selected value in the select box is 30.	empty array - []	No
     */
    private $_rowList;

    /**
     * @var type
     * @default
     * @editable
     * boolean	If this option is set to true, a new column at left of the grid is added. The purpose of this column is to count the number of available rows, beginning from 1. In this case colModel is extended automatically with new element with name - 'rn'. Also, be careful not to use the name 'rn' in colModel	false	No
     */
    private $_rownumbers;

    /**
     * Seta quantos registros nós conseguimos ver no grid
     * 
     * @var type
     * @default 20
     * @editable true
     * integer	Sets how many records we want to view in the grid.
     * This parameter is passed to the url for use by the server routine retrieving the data.
     * Note that if you set this parameter to 10 (i.e. retrieve 10 records)
     * and your server return 15 then only 10 records will be loaded.
     * Set this parameter to -1 (unlimited) to disable this checking. 	20	Yes
     */
    private $_rowNum;

    /**
     * Receberá as linhas contendo dados para futuramente serem adicionadas
     * no grid.
     * 
     * Criado mais para gerenciar de uma maneira melhor o fluxo de dados
     * plotados no grid, quando precisamos implementar uma grande quantidade de dados
     * no grid
     * 
     * @var type array
     */
    private $_rows;

    /**
     * Quando setamos este parâmetro conseguimos
     * instruir o servidor para carregar o número total de linhas que precisamos para trabalhar em cima.
     * 
     * Saiba que o rowNum determina o total de dados exibidos no grid, enquanto o rowTotal o total de linhas
     * em que nós operamos.
     * 
     * Nós também conseguimos enviar um parâmetro adicional para o server nomear o total de linhas
     * criando assim uma referência para acesso a todas as linhas.
     * 
     * Principalmente este parâmetro pode ser combinado com o parâmetro loadonce definido como verdadeiro.
     * 
     * @var type integer
     * @default null
     * @editable true
     */
    private $_rowTotal;

    /**
     * @var type Determina a largura do número de linhas se rownumbers é setado como true
     * @default 25
     * @editable false
     */
    private $_rownumWidth;

    /**
     * Parâmetro somente leitura, é usado quando editamos os registros inline ou editamos células à parte para armazenar os dados
     * Veja edição de Cell editing ou Inline editing
     * 
     * @var type array
     * @default empty array
     * @editable false
     */
    private $_savedRow;

    /**
     * Cria um scroll dinâmico para os grids
     * Quando habilitado, a paginação dos elementos é desabilitada e os dados são carregados quando
     * o scrollbar é usado.
     * 
     * Quando setamos true o grid sempre o grid carrega todos os dados possível resgatados, quando é setado 1
     * o grid vai carregando os dados de acordo com a rolagem do scroll melhorando o gerenciamento de memória
     * 
     * Adicionais: Nós temos uma extensão opcional para o protocolo do servidor. npage ( veja em prmName array ).
     * Se setamos npage em prmName, o grid faz solicitação de mais de uma página por vez
     * Se não ele só executa múltiplas requisições
     * 
     * @var type boolean ou integer
     * @default false
     * @editable false
     */
    private $_scroll;

    /**
     * Determina a largura do scrollbar vertical.
     * Cada browser interpreta diferente esse valor, dificultando assim o cálculo para igualar a largura em todos
     * 
     * @var type
     * @default 18
     * @editable false
     */
    private $_scrollOffset;

    /**
     * Este controla o tempo limite do scroll quando setado como 1
     * @var type integer
     * @default 200 (milliseconds)
     * @editable true
     */
    private $_scrollTimeout;

    /**
     * Quando habilitada, selecionando a linha com setSelection ele rola o grid até a linha ficar visível
     * Isso é usado quando nós tem um scroll vertical visível e nós usamos um formulário de edição com botões de navegação
     * próxima e anterior linha. Ao navegar quando se a próxima/anterior linha estiver escondida o grid rola o scroll para torná-la vísivel
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_scrollrows;

    /**
     * Esta opção é somente leitura
     * Determina as linhas atuais selecionadas quando o multiselect é setado como true
     * É um array unidimensional que corresponde a todos os id's da linhas selecionadas no grid
     * 
     * @var type array
     * @default empty array
     * @editable false
     */
    private $_selarrrow;

    /**
     * Esta opção é somente leitura
     * Contém o id da última linha selecionada.
     * Se você ordena ou muda de página esta opção é setada como null
     * 
     * @var type string
     * @default null
     * @editable false
     */
    private $_selrow;

    /**
     * Esta opção descreve o tipo de cálculo da largura inicial de cada coluna contando com a largura do grid
     * Se estiver como true o valor do parâmetro width é setado como: 
     * 
     * Toda a largura da coluna é dimensionada de acordo com a largura da opção definida.
     * Exemplo:
     *          se definir duas colunas com uma largura de 80 e 120 pixels, mas quer a grade
     *          para ter um 300 pixels - em seguida, as colunas são recalculadas como segue:
     *          1 - coluna = 300 (nova largura) / 200 (soma de toda a largura ) * 80 (largura da coluna) = coluna 120 e 2 = 300/200 * 120 = 180.
     * 
     * O width do grid é 300px. Se o valor for falso o valor do width é definido como:
     * O width do grid é o width definido na opção.
     * A largura da coluna não são recalculadas e tem os valores definidos em colModel.
     * Se é definido com integer, o width é calculado de acordo com este valor.
     * 
     * @var type boolean ou integer
     * @default true
     * @editable false
     * 
     */
    private $_shrinkToFit;

    /**
     * Quando habilitado esta opção permite a reordenação das linhas com o mouse.
     * Esta opção usa o widget jQuery UI para ordenação.
     * Certamente que este widget está relacionados a outros arquivos que são carregados na tag <head>
     * Você precisa também do grid.jqueryui.js quando você faz o download do jqGrid
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_sortable;

    /**
     * Nome da ordenação de dados inicial quando usamos datatypes como xml ou json
     * Este parâmetro é adicionado a url
     * Se definida esta opção, e o índice coincide com algum nome dentro de colModel então esta coluna
     * por padrão é adicionada uma imagem simbolizando que há possibilidade de ordenação. De acordo com o que foi
     * setado no sortorder
     * 
     * @var type string
     * @default empty string
     * @editable true
     * If set and the index (name) match the name from colModel then to this column by default is added a image sorting icon, according to the parameter sortorder (below). See prmNames.
     */
    private $_sortname;

    /**
     * A ordenação inicial do dados quando usamos datatypes como xml ou json
     * Este parâmetro é adicionado a url - veja prnName.
     * Há duas possibilidades: asc ou desc
     * 
     * @var type string
     * @default asc
     * @editable true
     */
    private $_sortorder;

    /**
     * Se for setado true habilita o uso da subgrid adicionando uma coluna no lado esquerdo da grid
     * Essa coluna contem um imagem 'plus' que indica que é possível expandir aquela linha
     * Todas as linhas como default são fechadas.
     * Veja o Subgrid
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_subGrid;

    /**
     * Para setar valores adicionais as opções do subgrid
     * Para maiores informações veja Subgrid.
     * 
     * @var type object
     * @default ''
     * @editable true
     */
    private $_subGridOptions;

    /**
     * Esta propriedade que descreve o modelo do subgrid tem efeito somente se o subGrid estiver como true
     * Isso é um array em que conseguimos descrever o modelo de colunas para os dados do subgrid
     * Para mais informações veja Subgrid
     * 
     * @var type array
     * @default empty array
     * @editable false
     */
    private $_subGridModel;

    /**
     * Esta opção permite o carregamento do subgrid como serviço
     * Se não for definida o valor do parâmetro datatype do pai deste subgrid é usado
     * 
     * @var type mixed
     * @default null
     * @editable true
     */
    private $_subGridType;

    /**
     * Esta opção só tem efeito se o subGrid estiver como true.
     * Esta opção recebe o local do arquivo de onde resgatamos os dados para o subgrid
     * o jqGrid adiciona o id ta linha como parâmetro para a url
     * Se for preciso passar parâmetros adicionais use a opção de parâmetros em subGridModel. Veja Subgrid
     * 
     * @var type string
     * @default empty string
     * @editable true
     */
    private $_subGridUrl;

    /**
     * Determina a largura da coluna do subGrid se o subgrid esta habilitado
     * 
     * @var type integer
     * @default 20
     * @editable false
     */
    private $_subGridWidth;

    /**
     * Esta opção define a toolbar do grid. O primeiro parâmetro do array habilita o toolbar
     * e o segundo define a posição em relação a camada do corpo.
     * Possíveis valores: "top","bottom", "both".
     * 
     * Quando a toolbar é setada: [true,"both"]
     * Duas toolbars são criadas - uma no topo da tabela de dados outra no rodapé.
     * 
     * Quando nós temos duas toolbars então criamos duas divs.
     * O id da do topo é construído como "t_" + id do grid e o do rodapé é "tb_" + id do grid
     * 
     * No caso quando somente uma toolbar é criada o id fica "t_" + id do grid independente da toolbar criada
     * tando do topo quando do rodapé
     * 
     * @var type array
     * @default [false,'']
     * @editable false
     */
    private $_toolbar;

    /**
     *
     * @var ZendT_Grid_Toolbar
     */
    private $_objToolbar;

    /**
     * Quando habilitamos esta opção, ela insere um elemento de paginação no topo do grid
     * abaixo da legenda se estiver habilitada.
     * Se existir outro elemento de paginação os dois são atualizados de forma síncrona
     * O identificador do elemento de paginação segue o seguinte formato: gridid+"_toppager"
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_toppager;

    /**
     * Parâmetro somente leitura
     * Medi o tempo de carregamento dos registros
     * Atualmente disponível somente quando o datatype for xml ou json
     * Além disso a checagem começa só quando a requisição estiver completa
     * quando estamos inserindo dados até a inserção da última linha
     * 
     * @var type integer
     * @default 0
     * @editable false
     */
    private $_totaltime;

    /**
     * Determina o tipo de dado inicial ( veja a opção datatype )
     * Geralmente isso não deve ser mudado
     * Durante o processo de leitura esta opção é igual ao datatype
     * 
     * @var type mixed
     * @default null
     * @editable false
     */
    private $_treedatatype;

    /**
     * Habilita ou desabilita o formato de treeGrid.
     * Para maiores detalhes veja Tree Grid
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_treeGrid;

    /**
     * Determina o método usado para o treeGrid
     * Podem ser nested ou adjacentes
     * Para melhor entendimento veja Tree Grid nested
     * 
     * @var type string
     * @default nested
     * @editable false
     */
    private $_treeGridModel;

    /**
     * Array usado para setar os ícones usados no tree
     * Os ícones devem contem os mesmo nomes definidos no UI them roller images 
     * 
     * @var type array
     * @default {plus:'ui-icon-triangle-1-e',minus:'ui-icon-triangle-1-s',leaf:'ui-icon-radio-off'}
     * @editable false
     */
    private $_treeIcons;

    /**
     * Extende o colModel. Os campos descritos neste parâmetro são adicionados no final do colModel e são ocultos.
     * Isto significa que os valores retornados do servidor devem ter valores para estes campos
     * Veja o Tree Grid para entender melhor sobre este parâmetro
     * 
     * @var type array
     * @default empty array
     * @editable false
     */
    private $_treeReader;

    /**
     * Determina o nível de onde o elemento da raiz inicia quando o treeGrid é habilitado
     * 
     * @var type numeric
     * @default 0
     * @editable false
     */
    private $_treeRootLevel;

    /**
     * Contém a url do arquivo que fazemos a requisição
     * 
     * @var type string
     * @default null
     * @editable true
     */
    private $_url;

    /**
     * Array que contém as informações customizadas de uma requisição. Usadas em qualquer hora.
     * 
     * @var type array
     * @default empty array
     * @editable false
     */
    private $_userData;

    /**
     * Quando setado como true, colocamos diretamente os dados do usuário no rodapé
     * Se os dados contém o nome igual aos definidos no colModel então o valor é colocado na coluna em questão.
     * Se não, não é colocado. 
     * 
     * Note que usamos essa opção é usada, usamos os formatador atual ( se definido ) para cada coluna
     * 
     * @var type boolean
     * @default false
     * @editable true
     */
    private $_userDataOnFooter;

    /**
     * Se estiver como true é exibido o número do primeiro registro da página atual
     * e o número do último registro.
     * Como default é exibida no lado direito da barra de paginação no seguinte formato
     * Exe: Visto 10 a 30 de 300
     * Com este valor como true conseguimos ajustar os parâmetros emptyrecords e recordtext
     * 
     * @var type boolean
     * @default false
     * @editable false
     */
    private $_viewrecords;

    /**
     * A finalidade deste parâmetro é definir visual diferente e comportamento de triagem ícones que aparecem perto do cabeçalho.
     * Este parâmetro é um array com as opções viewsortcols padrão à seguir: [false, 'vertical', true].
     * O primeiro parâmetro determina se todos os ícones devem ser vistos ao mesmo tempo
     * quando todas as colunas têm propriedade de classificação definido como true.
     * 
     * O default false determina que apenas os ícones da coluna em que está havendo a ordenação devem ser visualizados.
     * 
     * Definindo este parâmetro para true faz com que todos os ícones em todas as colunas ordenadas ​​devem ser visualizados.
     * O segundo parâmetro determina como os ícones devem ser exibidos
     * - vertical significa que os ícones de ordenação estão um abaixo do outro
     * - horizontal significa que os ícones devem ser um do lado do outro
     * 
     * O terceiro parâmetro determina a funcionalidade de clique, se true
     * as colunas são classificadas quando o cabeçalho for clicado. Se false só haverá ordenação quando os ícones forem clicados
     * 
     * Nota importante: Quando o terceiro parâmetro for false, verifique se o primeiro está como true, caso contrário
     * não haverá ordenação.
     * 
     * @var type array
     * @default ''
     * @editable false
     */
    private $_viewsortcols;

    /**
     * Se esta opção não é setada, o width do grid é a soma das larguras das colunas definas no colModel ( em pixeis )
     * Se esta opção é setada a largura inicial de cada colina é setada de acordo com o valor de shrinkToFit
     * 
     * @var type number
     * @default none
     * @editable false
     */
    private $_width;

    /**
     * Array que descreve a estrutura esperada dos dados de um xml
     * Para uma descrição completa veja o Retrieving Data XML Data.
     * 
     * @var type array
     * @default ''
     * @editable false
     */
    private $_xmlReader;

    /** ==========================================================
     * Eventos
      ============================================================== */

    /**
     * Este evento é disparado sempre depois de uma linha inserida
     *
     * @var type string
     * @param rowid, rowdata, rowelem
     * 
     * rowid - Id da linha inserida
     * rowdata - É um array dos dados inseridos na linha em questão.
     *           É um array do tipo nome: valor, onde o nome é o nome da propriedade colModel
     * rowelem - É o elemento da resposta. Se os dados provémd e um xml, será um elemento xml para linha
     *                                     Se os dados são json esses dados serão um array contendo todos os dados para linha
     * 
     * Note que este evento não é disparado se a opção gridview é setada como true
     * 
     */
    private $_afterInsertRow;

    /**
     * Este evento é disparado antes do processamento dos dados do servidor
     * Note que os dados são formatados dependendo do valor do parâmetro datatype - i.e se datatype é 'json'
     * por exemplo os dados são um objeto de JavaScript
     * 
     * @var type string
     * @param data, status, xhr 
     */
    private $_beforeProcessing;

    /**
     * O evento é disparado antes de qualquer requisição de dados.
     * Também não é disparado se o datatype for uma função
     * 
     * Se o vento retornar false a requisição não é feita para o servidor
     * 
     * @var type string
     * @param none 
     */
    private $_beforeRequest;

    /**
     * Este evento é disparado quando o usuário clicar na linha, mas antes do elemento ser selecionado
     * Este evento deve retornar um valor boleano.
     * 
     * Se o evento retornar true a seleção é feita
     * Se o evento retornar false a linha não será selecionada e qualquer
     * outra ação realizada não ocorrerá
     * 
     * @var type string
     * @param rowid, e
     * 
     * rowid - id da linha
     * e - evento do objeto
     * 
     */
    private $_beforeSelectRow;

    /**
     * Este evento é disparado depois que todos os dados forem carregados
     * pelo grid e todos os processos forem completados.
     * 
     * Também o evento é disparado independente do datatype e depois de uma ação de
     * paginação e etc
     * 
     * @var type string
     * @param none
     */
    private $_gridComplete;

    /**
     * Uma pré-chamada para modificar o objeto XMLHttpRequest(xhr) antes de ser mandado.
     * Use isto para customizar cabeçalhos de requisição.
     * Retornando false será cancelada a requisição
     * 
     * @var type string
     * @param xhr, settings 
     */
    private $_loadBeforeSend;

    /**
     * Este evento é executado imediatamente depois de qualquer requisição servidor.
     * Dados da resposta dependem do datatype que é um dos parâmetros do grid
     * 
     * @var type string
     * @param data
     */
    private $_loadComplete;

    /**
     * A função é chamada se a requisição falhar
     * Este função pega três argumentos passados:
     * 1 - XMLHttpRequest ( xhr )
     * 2 - String descrevendo o tipo de erro ( status )
     * 3 - O que ocorreu e um objeto de exceção opcional ( error )
     * 
     * @var type string
     * @param xhr, status, error
     */
    private $_loadError;

    /**
     * Disparado quando nós clicamos em uma célula particular no grid
     * 
     * @var type string
     * @param rowid, iCol, cellcontent, e
     * 
     * rowid - É o id da linha
     * iCol - É o index da célula
     * cellcontent - É o conteúdo da célula
     * e - é o objeto de evento do elemento que nós clicamos
     * Note que isso é habilitado quando nós não usamos o módulo de edição de célula e desabilitamos quando
     * usamos edição de célula
     * 
     */
    private $_onCellSelect;

    /**
     * Executado imediatamente depois que a linha sofre um clique duplo
     * 
     * @var type string
     * @param rowid, iRow, iCol, e
     * 
     * rowid - É o id da linha
     * iRow - É o index da linha ( não é misturada com o rowid )
     * iCol - É o index da célula
     * e - É o objeto de evento
     * 
     */
    private $_ondblClickRow;

    /**
     * Disparado depois de clicarmos para esconder ou exibir o click
     * O estado do grid é o parâmetro state do grid - conseguimos ter dois valores - visible ou hidden
     * 
     * 
     * @var type string
     * @param gridstate
     */
    private $_onHeaderClick;

    /**
     * Disparado depois que clicamos em algum botão para paginar os dados ( botões de paginação )
     * e antes que o grid seja populado de dados
     * 
     * Também trabalha quando os usuário entram com um novo número de pagina no input box que mostra qual página está
     * sendo exibida e quando o número de linhas requisitada é mudado via select box.
     * 
     * Neste evento nós passamos somente um parâmetro pgButton. Veja pager
     * Se o evento retornar true 'stop' o processo é parado e você consegue definir sua paginação customizada
     * 
     * @var type string
     * @param pgButton
     */
    private $_onPaging;

    /**
     * Disparado imediatamente depois que uma linha recebe um clique com o botão direito do mouse
     * 
     * @var type string
     * @param rowid, iRow, iCol, e
     * 
     * rowid - É o id da linha
     * iRow - O index da linha ( não misturado com o rowid )
     * iCol - É o index da célula
     * e - É o objeto do evento
     * 
     * Note que o evento não trabalha no Opera, porque ele não suporta evento oncontextmenu
     */
    private $_onRightClickRow;

    /**
     * Este evento é disparado quando o parâmetro multiselect é setado como true e quando o checkbox do cabeçalho é
     * clicado.
     * 
     * aRowids - array das linhas selecionadas ( rowid's )
     * status - variável boleana determinando o status do checkbox do cabeçalho - true se checked, false se não checked.
     * Note que o aRowids sempre contérá os ids quando o checkbox do cabeçalho for clicado ou não for checado
     * 
     * @var type string
     * @param aRowids, status
     */
    private $_onSelectAll;

    /**
     * Disparado imediatamente depois que uma linha é clicada
     * 
     * @var type string
     * @param rowid, status
     * 
     * rowid - id da linha
     * status - é o status da seleção. Conseguimos usar quando multiselect é setado como true.
     *          true se a linha é selecionada e false para quando tiramos a seleção
     * 
     */
    private $_onSelectRow;

    /**
     * Disparado imediatamente depois que clicamos para odernação da coluna e antes dos dados serem reordenados
     * 
     * @var type string
     * @param index, iCol, sortorder
     * 
     * index - é o nome do index do colModel,
     * iCol - é o index da coluna
     * sortorder - é a nova ordem de disposição dos dados - 'asc' ou 'desc'
     * Se o evento retorna 'stop' a reordenação é parada e você consegue definir sua ordenação customizada
     * 
     */
    private $_onSortCol;

    /**
     * Evento que é chamado quando nós reajustamos a largura da coluna.
     * 
     * @var type string
     * @param event, index
     * 
     * event - É o objeto de evento
     * index - É o index da coluna no colModel
     * 
     */
    private $_resizeStart;

    /**
     * Chamado depois que a coluna é redimensionada.
     * 
     * @var type string
     * @param newwidth, index
     * 
     * newwidth - É a nova largura da coluna
     * index - É o index da coluna no colModel
     * 
     */
    private $_resizeStop;

    /**
     * Se setamos este evento conseguimos serializar os dados passados para uma
     * requisição ajax.
     * 
     * A função deve retornar dados serializados
     * O evento cosnegue ser usado quando dados customizados devem ser passados para o servidor
     * e.g - JSON string, XML string e etc.
     * 
     * Para este evento passamos um array postData
     * 
     * @var type string
     * @param postData
     */
    private $_serializeGridData;

    /**
     * @var type array
     */
    private $_events;

    /**
     * @var array
     */

    /**
     *
     * @var \ZendT_Grid_Methods
     */
    private $_methods;
    
    /**
     * Adicionar filtro nas colunas
     * 
     * @var bool
     */
    private $_filterToolbar;
    /**
     * @var array
     */
    private $_options = array(
        'recordtext' => "Visualizando {0} - {1} de {2}",
        'emptyrecords' => "Nenhum registro encontrado!",
        'loadtext' => "Carregando...",
        'pgtext' => "P&aacute;gina {0} de {1}"
    );
    /**
     * @var array
     */
    private $_objects = array();
    /**
     * Crio propriedades essenciais para o funcionamento do grid
     * 
     * 1 -  Crio um objeto ColNames ( para ser inserido o nome das colunas )
     *      para futuramente nos métodos 'addColumn' ou 'addColumns' possamos inserir
     *      os nomes das mesmas
     * 
     * 2 -  Crio o objeto ColModel, essencial para o funcionamento do grid
     *      pois possui todas as configurações específicas para cada coluna
     * 
     * 3 -  Crio o objeto Navigator, que receberá tanto botões como objetos para
     *      paginação e exibição de registros por página e entre outras informações
     *      relacionadas ao conteúdo do grid
     * 
     * 4 -  Crio o HTML para renderização
     * 5 -  Realizo um merge das opções defaults com as passados pelo implementador
     * 
     * @param string $id
     * @param array $options 
     */
    public function __construct($id, array $options = array()) {
        $colNames = new ZendT_Grid_Property_ColNames();
        $colModel = new ZendT_Grid_Property_ColModel();
        $this->setNavigator(new ZendT_Grid_Navigator($id));
        $this->setMethods(new ZendT_Grid_Methods($id));
        $this
                ->setID($id)
                ->setHtml('<table id="' . $id . '"></table>' . $this->getNavigator()->getHtml())
                ->setColNames($colNames)
                ->setColModel($colModel);

        $this->_options = array_merge($this->getOptions(), $options);
        $this->_rows = array();
        $this->_filterToolbar = false;
        $this->_useColSpanStyle = false;
        $this->_objects = array();
    }

    /**
     * Seto o id do grid, na maioria das vezes e é recomendado que se use
     * nomes iniciando com letras
     * exe: grid-conhecimento
     * 
     * @param string $id
     * @return \ZendT_Grid 
     */
    public function setID($id) {
        $this->_id = $id;
        return $this;
    }

    /**
     * Retorno o id do grid exe: #grid-conhecimento, #grid-usuarios
     * @return string
     */
    public function getID() {
        return $this->_id;
    }

    /**
     * Resgato todas as opçoes à serem implementadas
     * no grid
     * 
     * @return type 
     */
    public function getOptions() {
        return $this->_options;
    }

    /**
     * Retorno todas as opções do ajaxGridOptions
     * 
     * @return object ou array 
     */
    public function getAjaxGridOptions() {
        return $this->_ajaxGridOptions;
    }

    public function setAjaxGridOptions($ajaxGridOptions) {
        $this->_ajaxGridOptions = $ajaxGridOptions;
        $this->_options['ajaxGridOptions'] = $ajaxGridOptions;
        return $this;
    }

    public function getAjaxSelectOptions() {
        return $this->_ajaxSelectOptions;
    }

    public function setAjaxSelectOptions($ajaxSelectOptions) {
        $this->_ajaxSelectOptions = $ajaxSelectOptions;
        $this->_options['ajaxSelectOptions'] = $ajaxSelectOptions;
        return $this;
    }

    public function getAltClass() {
        return $this->_altclass;
    }

    public function setAltClass($altclass) {
        $this->_altclass = $altclass;
        $this->_options['altclass'] = $altclass;
        return $this;
    }

    public function getAltRows() {
        return $this->_altRows;
    }

    public function setAltRows($altRows) {
        $this->_altRows = $altRows;
        $this->_options['altRows'] = $altRows;
        return $this;
    }

    public function getAutoEncode() {
        return $this->_autoencode;
    }

    public function setAutoEncode($autoencode) {
        $this->_autoencode = $autoencode;
        $this->_options['autoencode'] = $autoencode;
        return $this;
    }

    public function getAutoWidth() {
        return $this->_autowidth;
    }

    public function setAutoWidth($autowidth) {
        $this->_autowidth = $autowidth;
        $this->_options['autowidth'] = $autowidth;
        return $this;
    }

    public function getCaption() {
        return $this->_caption;
    }

    public function setCaption($caption) {
        $this->_caption = $caption;
        $this->_options['caption'] = $caption;
        return $this;
    }

    public function getCellLayout() {
        return $this->_cellLayout;
    }

    public function setCellLayout($cellLayout) {
        $this->_cellLayout = $cellLayout;
        $this->_options['cellLayout'] = $cellLayout;
        return $this;
    }

    public function getCellEdit() {
        return $this->_cellEdit;
    }

    public function setCellEdit($cellEdit) {
        $this->_cellEdit = $cellEdit;
        $this->_options['cellEdit'] = $cellEdit;
        return $this;
    }

    public function getCellSubmit() {
        return $this->_cellsubmit;
    }

    public function setCellSubmit($cellsubmit) {
        $this->_cellsubmit = $cellsubmit;
        $this->_options['cellsubmit'] = $cellsubmit;
        return $this;
    }

    public function getCellUrl() {
        return $this->_cellurl;
    }

    public function setCellUrl($cellurl) {
        $this->_cellurl = $cellurl;
        $this->_options['cellurl'] = $cellurl;
        return $this;
    }

    public function getCmTemplate() {
        return $this->_cmTemplate;
    }

    public function setCmTemplate($cmTemplate) {
        $this->_cmTemplate = $cmTemplate;
        $this->_options['cmTemplate'] = $cmTemplate;
        return $this;
    }
    /**
     *
     * @return ZendT_Grid_Property_ColModel 
     */
    public function getColModel() {
        return $this->_colModel;
    }

    public function setColModel($colModel) {
        $this->_colModel = $colModel;
        $this->_options['colModel'] = $colModel;
        return $this;
    }

    public function getColNames() {
        return $this->_colNames;
    }

    public function setColNames($colNames) {
        $this->_colNames = $colNames;
        $this->_options['colNames'] = $colNames;
        return $this;
    }

    public function getData() {
        return $this->_data;
    }

    public function setData($data) {
        $this->_data = $data;
        $this->_options['data'] = $data;
        return $this;
    }

    public function getDataStr() {
        return $this->_datastr;
    }

    public function setDataStr($datastr) {
        $this->_datastr = $datastr;
        $this->_options['datastr'] = $datastr;
        return $this;
    }

    public function getDataType() {
        return $this->_datatype;
    }

    public function setDataType($datatype) {
        $this->_datatype = $datatype;
        $this->_options['datatype'] = $datatype;
        return $this;
    }

    public function getDeepEmpty() {
        return $this->_deepempty;
    }

    public function setDeepEmpty($deepempty) {
        $this->_deepempty = $deepempty;
        $this->_options['deepempty'] = $deepempty;
        return $this;
    }

    public function getDeselectAfterSort() {
        return $this->_deselectAfterSort;
    }

    public function setDeselectAfterSort($deselectAfterSort) {
        $this->_deselectAfterSort = $deselectAfterSort;
        $this->_options['deselectAfterSort'] = $deselectAfterSort;
        return $this;
    }

    public function getDirection() {
        return $this->_direction;
    }

    public function setDirection($direction) {
        $this->_direction = $direction;
        $this->_options['direction'] = $direction;
        return $this;
    }

    public function getEditUrl() {
        return $this->_editurl;
    }

    public function setEditUrl($editurl) {
        $this->_editurl = $editurl;
        $this->_options['editurl'] = $editurl;
        return $this;
    }

    public function getEmptyRecords() {
        return $this->_emptyrecords;
    }

    public function setEmptyRecords($emptyrecords) {
        $this->_emptyrecords = $emptyrecords;
        $this->_options['emptyrecords'] = $emptyrecords;
        return $this;
    }

    public function getEvents() {
        return $this->_options['events'];
    }

    public function setEvents($events) {
        $this->_events = $events;
        $this->_options['events'] = $events;
        return $this;
    }

    public function setEvent($key, $funcao) {
        $this->_options['events'][$key] = $funcao;
        return $this;
    }

    public function getMethods() {
        return $this->_methods;
    }

    public function setMethods($methods) {
        $this->_methods = $methods;
        return $this;
    }

    public function setPostDataMethod($key, $value = null) {
        $this->getMethods()->setMethodPostData($key, $value);
        return $this;
    }

    public function getExpandColClick() {
        return $this->_ExpandColClick;
    }

    public function setExpandColClick($ExpandColClick) {
        $this->_ExpandColClick = $ExpandColClick;
        $this->_options['ExpandColClick'] = $ExpandColClick;
        return $this;
    }

    public function getExpandColumn() {
        return $this->_ExpandColumn;
    }

    public function setExpandColumn($ExpandColumn) {
        $this->_ExpandColumn = $ExpandColumn;
        $this->_options['ExpandColumn'] = $ExpandColumn;
        return $this;
    }

    public function getFooterRow() {
        return $this->_footerrow;
    }

    public function setFooterRow($footerrow) {
        $this->_footerrow = $footerrow;
        $this->_options['footerrow'] = $footerrow;
        return $this;
    }

    public function getForceFit() {
        return $this->_forceFit;
    }

    public function setForceFit($forceFit) {
        $this->_forceFit = $forceFit;
        $this->_options['forceFit'] = $forceFit;
        return $this;
    }

    public function getGridState() {
        return $this->_gridstate;
    }

    public function setGridState($gridstate) {
        $this->_gridstate = $gridstate;
        $this->_options['gridstate'] = $gridstate;
        return $this;
    }

    public function getGridView() {
        return $this->_gridview;
    }

    public function setGridView($gridview) {
        $this->_gridview = $gridview;
        $this->_options['gridview'] = $gridview;
        return $this;
    }

    public function getGrouping() {
        return $this->_grouping;
    }

    public function setGrouping($grouping) {
        $this->_grouping = $grouping;
        $this->_options['grouping'] = $grouping;
        return $this;
    }

    public function getHeaderTitles() {
        return $this->_headertitles;
    }

    public function setHeaderTitles($headertitles) {
        $this->_headertitles = $headertitles;
        $this->_options['headertitles'] = $headertitles;
        return $this;
    }

    /**
     * Determina se será adicionado outra linha de cabeçalho
     * 
     * @param boolean $value
     * @return \ZendT_Grid 
     */
    public function setGroupHeaders($value) {
        $this->_groupHeaders = $value;
        return $this;
    }
    
    /**
     * Determina se a tabela do groupHeader terá ColSpan quando existir
     * 
     * @param boolean $value
     * @return \ZendT_Grid 
     */
    public function setUseColSpanStyle($value) {
        $this->_useColSpanStyle = $value;
        return $this;
    }

    public function getHeight() {
        return $this->_height;
    }

    public function setHeight($height) {
        $this->_height = $height;
        $this->_options['height'] = $height;
        return $this;
    }

    public function getHiddenGrid() {
        return $this->_hiddengrid;
    }

    public function setHiddenGrid($hiddengrid) {
        $this->_hiddengrid = $hiddengrid;
        $this->_options['hiddengrid'] = $hiddengrid;
        return $this;
    }

    public function getHideGrid() {
        return $this->_hidegrid;
    }

    public function setHideGrid($hidegrid) {
        $this->_hidegrid = $hidegrid;
        $this->_options['hidegrid'] = $hidegrid;
        return $this;
    }

    public function getHoverRows() {
        return $this->_hoverrows;
    }

    public function setHoverRows($hoverrows) {
        $this->_hoverrows = $hoverrows;
        $this->_options['hoverrows'] = $hoverrows;
        return $this;
    }

    public function getHtml() {
        return $this->_html;
    }

    public function setHtml($html) {
        $this->_html = $html;
        return $this;
    }

    public function getIdPrefix() {
        return $this->_idPrefix;
    }

    public function setIdPrefix($idPrefix) {
        $this->_idPrefix = $idPrefix;
        $this->_options['idPrefix'] = $idPrefix;
        return $this;
    }

    public function getIgnoreCase() {
        return $this->_ignoreCase;
    }

    public function setIgnoreCase($ignoreCase) {
        $this->_ignoreCase = $ignoreCase;
        $this->_options['ignoreCas'] = $ignoreCas;
        return $this;
    }

    public function getInlineData() {
        return $this->_inlineData;
    }

    public function setInlineData($inlineData) {
        $this->_inlineData = $inlineData;
        $this->_options['inlineData'] = $inlineData;
        return $this;
    }

    public function getJS() {
        return $this->_js;
    }

    public function setJS($js) {
        $this->_js = $js;
        return $this;
    }

    public function getJsonReader() {
        return $this->_jsonReader;
    }

    public function setJsonReader($jsonReader) {
        $this->_jsonReader = $jsonReader;
        $this->_options['jsonReader'] = $jsonReader;
        return $this;
    }

    public function getLastPage() {
        return $this->_lastpage;
    }

    public function setLastPage($lastpage) {
        $this->_lastpage = $lastpage;
        $this->_options['lastpage'] = $lastpage;
        return $this;
    }

    public function getLastSort() {
        return $this->_lastsort;
    }

    public function setLastSort($lastsort) {
        $this->_lastsort = $lastsort;
        $this->_options['lastsort'] = $lastsort;
        return $this;
    }

    public function getLoadOnce() {
        return $this->_loadonce;
    }

    public function setLoadOnce($loadonce) {
        $this->_loadonce = $loadonce;
        $this->_options['loadonce'] = $loadonce;
        return $this;
    }

    public function getLoadText() {
        return $this->_loadtext;
    }

    public function setLoadText($loadtext) {
        $this->_loadtext = $loadtext;
        $this->_options['loadtext'] = $loadtext;
        return $this;
    }

    public function getLoadUi() {
        return $this->_loadui;
    }

    public function setLoadUi($loadui) {
        $this->_loadui = $loadui;
        $this->_options['loadui'] = $loadui;
        return $this;
    }

    public function getMType() {
        return $this->_mtype;
    }

    public function setMType($mtype) {
        $this->_mtype = $mtype;
        $this->_options['mtype'] = $mtype;
        return $this;
    }

    public function getMultiKey() {
        return $this->_multikey;
    }

    public function setMultiKey($multikey) {
        $this->_multikey = $multikey;
        $this->_options['multikey'] = $multikey;
        return $this;
    }

    public function getMultiBoxOnly() {
        return $this->_multiboxonly;
    }

    public function setMultiBoxOnly($multiboxonly) {
        $this->_multiboxonly = $multiboxonly;
        $this->_options['multiboxonly'] = $multiboxonly;
        return $this;
    }

    public function getMultiSelect() {
        return $this->_multiselect;
    }

    public function setMultiSelect($multiselect) {
        $this->_multiselect = $multiselect;
        $this->_options['multiselect'] = $multiselect;
        return $this;
    }

    public function getMultiSelectWidth() {
        return $this->_multiselectWidth;
    }

    public function setMultiSelectWidth($multiselectWidth) {
        $this->_multiselectWidth = $multiselectWidth;
        $this->_options['multiselectWidth'] = $multiselectWidth;
        return $this;
    }
    /**
     * Busca o objeto ZendT_Grid_Navigator
     *
     * @return ZendT_Grid_Navigator
     */
    public function getNavigator() {
        return $this->_navigator;
    }
    /**
     *
     * @param ZendT_Grid_Navigator $navigator
     * @return \ZendT_Grid 
     */
    public function setNavigator($navigator) {
        $this->_navigator = $navigator;
        return $this;
    }

    public function getPage() {
        if ($this->_page == '')
            $this->_page = 1;
        return $this->_page;
    }

    public function setPage($page) {
        $this->_page = $page;
        $this->_options['page'] = $page;
        return $this;
    }

    public function getPager() {
        return $this->_pager;
    }

    public function setPager($pager) {
        $this->_pager = $pager;
        $this->_options['pager'] = $pager;
        return $this;
    }

    public function getPagerPos() {
        return $this->_pagerpos;
        return $this;
    }

    public function setPagerPos($pagerpos) {
        $this->_pagerpos = $pagerpos;
        $this->_options['pagerpos'] = $pagerpos;
    }

    public function getPgButtons() {
        return $this->_pgbuttons;
        return $this;
    }

    public function setPgButtons($pgbuttons) {
        $this->_pgbuttons = $pgbuttons;
        $this->_options['pgbuttons'] = $pgbuttons;
        return $this;
    }

    public function getPgInput() {
        return $this->_pginput;
    }

    public function setPgInput($pginput) {
        $this->_pginput = $pginput;
        $this->_options['pginput'] = $pginput;
        return $this;
    }

    public function getPgText() {
        return $this->_pgtext;
    }

    public function setPgText($pgtext) {
        $this->_pgtext = $pgtext;
        $this->_options['pgtext'] = $pgtext;
        return $this;
    }

    public function getPrmNames() {
        return $this->_prmNames;
    }

    public function setPrmNames($prmNames) {
        $this->_prmNames = $prmNames;
        $this->_options['prmNames'] = $prmNames;
        return $this;
    }

    public function getPostData() {
        return $this->_postData;
    }

    /**
     * Função criada  
     */
    private function renderPostData() {
        if (is_string($this->_postData)) {
            $this->setPostData(str_replace('\\', '', $this->getPostData()));
            $this->setPostData(Zend_Json::decode($this->getPostData()));
        }        
        $this->_postData['_search'] = false;
        $this->_postData['nd'] = 'function(){return Math.random();}';
        $this->_postData['page'] = $this->getPage();
        $this->_postData['rows'] = $this->getRowNum();
        $this->_postData['sidx'] = $this->getSortName();
        $this->_postData['sord'] = $this->getSortOrder();

        $this->setPostData(Zend_Json::encode($this->getPostData()));
        /**
         * @todo verificar se o ND está processando a função no Browser, já
         * que o json codifica com aspas e não fica uma notação original. 
         */
        $this->_options['postData'] = $this->getPostData();
    }

    public static function arrayToUrl($array, $prefix = '') {
        $url = '';
        foreach ($array as $key => $value) {
            $url.= '&';
            if (is_array($value)) {
                if ($prefix)
                    $url.= ZendT_Grid::arrayToUrl($value, $prefix . '[' . $key . ']');
                else
                    $url.= ZendT_Grid::arrayToUrl($value, $key);
            }else {
                if ($prefix)
                    $url.= $prefix . '[' . $key . ']=' . urlencode($value);
                else
                    $url.= $key . '=' . urlencode($value);
            }
        }
        return substr($url, 1);
    }

    public function setPostData($postData) {
        $this->_postData = $postData;
        return $this;
    }

    /**
     * Configura o postData do grid baseado
     * na nomenclatura de filtro
     * 
     * Todas as variáveis do POST que começar com "filter"
     * segue a nomenclatura estabelecida
     * 
     * @param array $params
     * @return ZendT_Grid
     */
    public function setPostDataFilter($params) {
        $postData = array();
        foreach ($params as $key => $value) {
            if ($key == 'filter')
                $postData[$key] = $value;
        }
        $this->setPostData($postData);
        return $this;
    }

    public function getRecCount() {
        return $this->_reccount;
    }

    public function setRecCount($reccount) {
        $this->_reccount = $reccount;
        $this->_options['reccount'] = $reccount;
        return $this;
    }

    public function getRecordPos() {
        return $this->_recordpos;
    }

    public function setRecordPos($recordpos) {
        $this->_recordpos = $recordpos;
        $this->_options['recordpos'] = $recordpos;
        return $this;
    }

    public function getRecords() {
        return $this->_records;
    }

    public function setRecords($records) {
        $this->_records = $records;
        $this->_options['records'] = $records;
        return $this;
    }

    public function getRecordText() {
        return $this->_recordtext;
    }

    public function setRecordText($recordtext) {
        $this->_recordtext = $recordtext;
        $this->_options['recordtext'] = $recordtext;
        return $this;
    }

    public function getResizeClass() {
        return $this->_resizeclass;
    }

    public function setResizeClass($resizeclass) {
        $this->_resizeclass = $resizeclass;
        $this->_options['resizeclass'] = $resizeclass;
        return $this;
    }

    public function getRowList() {
        return $this->_rowList;
    }

    public function setRowList($rowList) {
        $this->_rowList = $rowList;
        $this->_options['rowList'] = $rowList;
        return $this;
    }

    public function getRowNumbers() {
        return $this->_rownumbers;
    }

    public function setRowNumbers($rownumbers) {
        $this->_rownumbers = $rownumbers;
        $this->_options['rownumbers'] = $rownumbers;
        return $this;
    }

    public function getRowNum() {
        return $this->_rowNum;
    }

    /**
     * 
     * @param type $_rowNum
     * @return \ZendT_Grid 
     */
    public function setRowNum($rowNum) {
        $this->_rowNum = $rowNum;
        $this->_options['rowNum'] = $rowNum;
        return $this;
    }

    public function getRowTotal() {
        return $this->_rowTotal;
    }

    public function setRowTotal($rowTotal) {
        $this->_rowTotal = $rowTotal;
        $this->_options['rowTotal'] = $rowTotal;
        return $this;
    }

    public function getRowNumWidth() {
        return $this->_rownumWidth;
    }

    public function setRowNumWidth($rownumWidth) {
        $this->_rownumWidth = $rownumWidth;
        $this->_options['rownumWidth'] = $rownumWidth;
        return $this;
    }

    public function getRows() {
        if (!is_array($this->_rows)){
            return array();
        }
        return $this->_rows;
    }

    public static function setRows($rows) {
        $this->_rows = $rows;
        return $this;
    }
    /**
     *
     * @param array $row
     * @param array $styles
     * @return \ZendT_Grid 
     */
    public function addRow($row,$styles=array()) {
        $this->_rows[] = $row;
        $this->_styles[] = $styles;
        return $this;
    }
    /**
     *
     * @param type $key
     * @return type 
     */
    public function getStyle($key){
        return $this->_styles[$key];
    }
    /**
     *
     * @return type 
     */
    public function getStyles(){
        return $this->_styles;
    }

    public function getSavedRow() {
        return $this->_savedRow;
    }

    public function setSavedRow($savedRow) {
        $this->_savedRow = $savedRow;
        $this->_options['savedRow'] = $savedRow;
        return $this;
    }

    public function getScroll() {
        return $this->_scroll;
    }

    public function setScroll($scroll) {
        $this->_scroll = $scroll;
        $this->_options['scroll'] = $scroll;
        return $this;
    }

    public function getScrollOffset() {
        return $this->_scrollOffset;
    }

    public function setScrollOffset($scrollOffset) {
        $this->_scrollOffset = $scrollOffset;
        $this->_options['scrollOffset'] = $scrollOffset;
        return $this;
    }

    public function getScrollTimeout() {
        return $this->_scrollTimeout;
    }

    public function setScrollTimeout($scrollTimeout) {
        $this->_scrollTimeout = $scrollTimeout;
        $this->_options['scrollTimeout'] = $scrollTimeout;
        return $this;
    }

    public function getScrollRows() {
        return $this->_scrollrows;
    }

    public function setScrollRows($scrollrows) {
        $this->_scrollrows = $scrollrows;
        $this->_options['scrollrows'] = $scrollrows;
        return $this;
    }

    public function getSelArrrow() {
        return $this->_selarrrow;
    }

    public function setSelArrrow($selarrrow) {
        $this->_selarrrow = $selarrrow;
        $this->_options['selarrrow'] = $selarrrow;
        return $this;
    }

    public function getSelRow() {
        return $this->_selrow;
        $this->_options['altrows'] = $altRows;
    }

    public function setSelRow($selrow) {
        $this->_selrow = $selrow;
        $this->_options['selrow'] = $selrow;
        return $this;
    }

    public function getShrinkToFit() {
        return $this->_shrinkToFit;
    }

    public function setShrinkToFit($shrinkToFit) {
        $this->_shrinkToFit = $shrinkToFit;
        $this->_options['shrinkToFit'] = $shrinkToFit;
        return $this;
    }

    public function getSortable() {
        return $this->_sortable;
    }

    public function setSortable($sortable) {
        $this->_sortable = $sortable;
        $this->_options['sortable'] = $sortable;
        return $this;
    }

    public function getSortName() {
        return $this->_sortname;
    }

    public function setSortName($sortname) {
        $this->_sortname = $sortname;
        $this->_options['sortname'] = $sortname;
        return $this;
    }

    public function getSortOrder() {
        return $this->_sortorder;
    }

    public function setSortOrder($sortorder) {
        $this->_sortorder = $sortorder;
        $this->_options['sortorder'] = $sortorder;
        return $this;
    }

    public function getSubGrid() {
        return $this->_subGrid;
    }

    public function setSubGrid($subGrid) {
        $this->_subGrid = $subGrid;
        $this->_options['subGrid'] = $subGrid;
        return $this;
    }

    public function getSubGridOptions() {
        return $this->_subGridOptions;
    }

    public function setSubGridOptions($subGridOptions) {
        $this->_subGridOptions = $subGridOptions;
        $this->_options['subGridOptions'] = $subGridOptions;
        return $this;
    }

    public function getSubGridModel() {
        return $this->_subGridModel;
    }

    public function setSubGridModel($subGridModel) {
        $this->_subGridModel = $subGridModel;
        $this->_options['subGridModel'] = $subGridModel;
        return $this;
    }

    public function getSubGridType() {
        return $this->_subGridType;
    }

    public function setSubGridType($subGridType) {
        $this->_subGridType = $subGridType;
        $this->_options['subGridType'] = $subGridType;
        return $this;
    }

    public function getSubGridUrl() {
        return $this->_subGridUrl;
    }

    public function setSubGridUrl($subGridUrl) {
        $this->_subGridUrl = $subGridUrl;
        $this->_options['subGridUrl'] = $subGridUrl;
        return $this;
    }

    public function getSubGridWidth() {
        return $this->_subGridWidth;
    }

    public function setSubGridWidth($subGridWidth) {
        $this->_subGridWidth = $subGridWidth;
        $this->_options['subGridWidth'] = $subGridWidth;
        return $this;
    }
    /**
     *
     * @return ZendT_Grid_Grouping 
     */
    public function getGroupingView(){
        return $this->_objects['groupingView'];
    }
    /**
     *
     * @param ZendT_Grid_Grouping $groupingView
     * @return \ZendT_Grid 
     */
    public function setGroupingView(ZendT_Grid_Grouping $groupingView){
        $this->_objects['groupingView'] = $groupingView;
        return $this;
    }    
    /**
     * Busca o objeto toolbar
     * 
     * @return ZendT_Grid_Toolbar
     */
    public function getToolbar() {
        return $this->_toolbar;
    }

    public function setToolbar($toolbar) {
        if (!$this->getObjToolbar() instanceof ZendT_Grid_Toolbar) {
            $this->setObjToolbar(new ZendT_Grid_Toolbar($this->getID()));
        }
        $this->_toolbar = $toolbar;
        $this->_options['toolbar'] = $toolbar;
        return $this;
    }
    /**
     * Busca o objeto toolbar
     * 
     * @return ZendT_Grid_Toolbar
     */
    public function getObjToolbar() {
        return $this->_objToolbar;
    }

    public function setObjToolbar($objToolbar) {
        $this->_objToolbar = $objToolbar;
        if ($objToolbar === null){
            $this->_options['toolbar'][0] = false;
        }
        return $this;
    }

    public function getTopPager() {
        return $this->_toppager;
    }

    public function setTopPager($toppager) {
        $this->_toppager = $toppager;
        $this->_options['toppager'] = $toppager;
        return $this;
    }

    public function getTotalTime() {
        return $this->_totaltime;
    }

    public function setTotalTime($totaltime) {
        $this->_totaltime = $totaltime;
        $this->_options['totaltime'] = $totaltime;
        return $this;
    }

    public function getTreeDataType() {
        return $this->_treedatatype;
    }

    public function setTreeDataType($treedatatype) {
        $this->_treedatatype = $treedatatype;
        $this->_options['treedatatype'] = $treedatatype;
        return $this;
    }

    public function getTreeGrid() {
        return $this->_treeGrid;
    }

    public function setTreeGrid($treeGrid) {
        $this->_treeGrid = $treeGrid;
        $this->_options['treeGrid'] = $treeGrid;
        return $this;
    }

    public function getTreeGridModel() {
        return $this->_treeGridModel;
    }

    public function setTreeGridModel($treeGridModel) {
        $this->_treeGridModel = $treeGridModel;
        $this->_options['treeGridModel'] = $treeGridModel;
    }

    public function getTreeIcons() {
        return $this->_treeIcons;
    }

    public function setTreeIcons($treeIcons) {
        $this->_treeIcons = $treeIcons;
        $this->_options['treeIcons'] = $treeIcons;
        return $this;
    }

    public function getTreeReader() {
        return $this->_treeReader;
    }

    public function setTreeReader($treeReader) {
        $this->_treeReader = $treeReader;
        $this->_options['treeReader'] = $treeReader;
        return $this;
    }

    public function getTreeRootLevel() {
        return $this->_treeRootLevel;
    }

    public function setTreeRootLevel($treeRootLevel) {
        $this->_treeRootLevel = $treeRootLevel;
        $this->_options['tree_root_level'] = $treeRootLevel;
        return $this;
    }

    public function getUrl() {
        return $this->_url;
    }

    public function setUrl($url) {
        $this->_url = $url;
        $this->_options['url'] = $url;
        return $this;
    }

    public function getUserData() {
        return $this->_userData;
    }

    public function setUserData($userData) {
        $this->_userData = $userData;
        $this->_options['userdata'] = $userData;
        return $this;
    }

    public function getUserDataOnFooter() {
        return $this->_userDataOnFooter;
    }

    public function setUserDataOnFooter($userDataOnFooter) {
        $this->_userDataOnFooter = $userDataOnFooter;
        $this->_options['userDataOnFooter'] = $userDataOnFooter;
        return $this;
    }

    public function getViewRecords() {
        return $this->_viewrecords;
    }

    public function setViewRecords($viewrecords) {
        $this->_viewrecords = $viewrecords;
        $this->_options['viewrecords'] = $viewrecords;
        return $this;
    }

    public function getViewSortCols() {
        return $this->_viewsortcols;
    }

    public function setViewSortCols($viewsortcols) {
        $this->_viewsortcols = $viewsortcols;
        $this->_options['viewsortcols'] = $viewsortcols;
        return $this;
    }

    public function getWidth() {
        return $this->_width;
    }

    public function setWidth($width) {
        $this->_width = $width;
        $this->_options['width'] = $width;
        return $this;
    }

    public function getXmlReader() {
        return $this->_xmlReader;
    }

    public function setXmlReader($xmlReader) {
        $this->_xmlReader = $xmlReader;
        $this->_options['xmlReader'] = $xmlReader;
        return $this;
    }

    public function getAfterInsertRow() {
        return $this->_afterInsertRow;
    }

    public function setAfterInsertRow($afterInsertRow) {
        $this->_afterInsertRow = $afterInsertRow;
        $this->setEvent('afterInsertRow', $afterInsertRow);
        return $this;
    }

    public function getBeforeProcessing() {
        return $this->_beforeProcessing;
    }

    public function setBeforeProcessing($beforeProcessing) {
        $this->_beforeProcessing = $beforeProcessing;
        $this->setEvent('beforeProcessing', $beforeProcessing);
        return $this;
    }

    public function getBeforeRequest() {
        return $this->_beforeRequest;
    }

    public function setBeforeRequest($beforeRequest) {
        $this->_beforeRequest = $beforeRequest;
        $this->setEvent('beforeRequest', $beforeRequest);
        return $this;
    }

    public function getBeforeSelectRow() {
        return $this->_beforeSelectRow;
    }

    public function setBeforeSelectRow($beforeSelectRow) {
        $this->_beforeSelectRow = $beforeSelectRow;
        $this->setEvent('beforeSelectRow', $beforeSelectRow);
        return $this;
    }

    public function getGridComplete() {
        return $this->_gridComplete;
    }

    public function setGridComplete($gridComplete) {
        $this->_gridComplete = $gridComplete;
        $this->setEvent('gridComplete', $gridComplete);
        return $this;
    }

    public function getLoadBeforeSend() {
        return $this->_loadBeforeSend;
    }

    public function setLoadBeforeSend($loadBeforeSend) {
        $this->_loadBeforeSend = $loadBeforeSend;
        $this->setEvent('loadBeforeSend', $loadBeforeSend);
        return $this;
    }

    public function getLoadComplete() {
        return $this->_loadComplete;
    }

    public function setLoadComplete($loadComplete) {
        $this->_loadComplete = $loadComplete;
        $this->setEvent('loadComplete', $loadComplete);
        return $this;
    }

    public function getLoadError() {
        return $this->_loadError;
    }

    public function setLoadError($loadError) {
        $this->_loadError = $loadError;
        $this->setEvent('loadError', $loadError);
        return $this;
    }

    public function getOnCellSelect() {
        return $this->_onCellSelect;
    }

    public function setOnCellSelect($onCellSelect) {
        $this->_onCellSelect = $onCellSelect;
        $this->setEvent('onCellSelect', $onCellSelect);
        return $this;
    }

    public function getOndblClickRow() {
        return $this->_ondblClickRow;
    }

    public function setOndblClickRow($ondblClickRow) {
        $this->_ondblClickRow = $ondblClickRow;
        $this->setEvent('ondblClickRow', $ondblClickRow);
        return $this;
    }

    public function getOnHeaderClick() {
        return $this->_onHeaderClick;
    }

    public function setOnHeaderClick($onHeaderClick) {
        $this->_onHeaderClick = $onHeaderClick;
        $this->setEvent('onHeaderClick', $onHeaderClick);
        return $this;
    }

    public function getOnPaging() {
        return $this->_onPaging;
    }

    public function setOnPaging($onPaging) {
        $this->_onPaging = $onPaging;
        $this->setEvent('onPaging', $onPaging);
        return $this;
    }

    public function getOnRightClickRow() {
        return $this->_onRightClickRow;
    }

    /**
     *
     * 
     * 
     * @param string $onRightClickRow
     * @return \ZendT_Grid 
     */
    public function setOnRightClickRow($onRightClickRow) {
        $this->_onRightClickRow = $onRightClickRow;
        $this->setEvent('onRightClickRow', $onRightClickRow);
        return $this;
    }

    public function getOnSelectAll() {
        return $this->_onSelectAll;
    }

    public function setOnSelectAll($onSelectAll) {
        $this->_onSelectAll = $onSelectAll;
        $this->setEvent('onSelectAll', $onSelectAll);
        return $this;
    }

    public function getOnSelectRow() {
        return $this->_onSelectRow;
    }

    public function setOnSelectRow($onSelectRow) {
        $this->_onSelectRow = $onSelectRow;
        $this->setEvent('onSelectRow', $onSelectRow);
        return $this;
    }

    public function getOnSortCol() {
        return $this->_onSortCol;
    }

    public function setOnSortCol($onSortCol) {
        $this->_onSortCol = $onSortCol;
        $this->setEvent('onSortCol', $onSortCol);
        return $this;
    }

    public function getResizeStart() {
        return $this->_resizeStart;
    }

    public function setResizeStart($resizeStart) {
        $this->_resizeStart = $resizeStart;
        $this->setEvent('resizeStart', $resizeStart);
        return $this;
    }

    public function getResizeStop() {
        return $this->_resizeStop;
    }

    public function setResizeStop($resizeStop) {
        $this->_resizeStop = $resizeStop;
        $this->setEvent('resizeStop', $resizeStop);
        return $this;
    }

    public function getSerializeGridData() {
        return $this->_serializeGridData;
    }

    public function setSerializeGridData($serializeGridData) {
        $this->_serializeGridData = $serializeGridData;
        $this->setEvent('serializeGridData', $serializeGridData);
        return $this;
    }

    /**
     * 
     * @param ZendT_Grid_Column $column
     * @return \ZendT_Grid
     */
    public function addColumn(ZendT_Grid_Column $column) {
        $this->_colNames->setName($column->getHeaderTitle());
        $this->_colModel->addColumn($column);
        return $this;
    }

    /**
     *
     * @param type \ZendT_Grid_Column[]
     * @return \ZendT_Grid 
     */
    public function addColumns($array) {
        $this->_colNames->setNames($array);
        $this->_colModel->setColumns($array);
        return $this;
    }

    public function column($key) {
        return $this->_colModel->getColumn($key);
    }
    /**
     *
     * @param string $key
     * @param ZendT_Grid_Button $button
     * @return \ZendT_Grid 
     */
    public function addNavigatorButton($key, $button) {
        $this->_navigator->setButton($key, $button);
        return $this;
    }
    /**
     *
     * @param string $key
     * @param ZendT_Grid_Button $button
     * @return \ZendT_Grid 
     */
    public function addToolbarButton($key, $button, $group='') {
        $this->_objToolbar->setButton($key, $button, $group);
        return $this;
    }
    /**
     *
     * @param string $key
     * @return ZendT_Grid_Button 
     */
    public function getToolbarButton($key) {
        return $this->_objToolbar->getButton($key);
    }
    /**
     * Formata os dados recebidos para implementar no Grid
     * transformando seu formato nativo ( array ) para Json
     * 
     * @param type int
     * @param type int
     * @param type array
     */
    public function toJson($currentPage, $rowsPerPage) {
        /**
         * Total de registros resgatados para plotar no ZendT_Grid
         * Quantidade de páginas implementadas no ZendT_Grid
         */
        $total = $this->getRecords();
        $qtdPages = ceil($total / $rowsPerPage);

        $data = array('page' => $currentPage, 'total' => $qtdPages, 'records' => $total);

        $hasId = false;
        foreach ($this->getColModel()->getColumns() as $key => $column) {
            if ($column->getName() == 'id') {
                $hasId = true;
                break;
            }
        }
        
        $stylesRow = $this->getStyles();

        $i = 0;
        foreach ($this->getRows() as $iLine => $row) {
            $data['rows'][$i]['id'] = $row['id'];
            if (!$hasId) {
                unset($row['id']);
            }
            $j = 0;            
            foreach ($row as $columName=>$property) {
                #$key = $column->getName();
                $style = '';
                if (isset($stylesRow[$iLine][$columName])){
                    foreach($stylesRow[$iLine][$columName] as $styleName=>$styleValue){
                        $style.= $styleName.':'.$styleValue.';';
                    }
                }
                if ($style){
                    $data['rows'][$i]['cell'][$j] = '<span style="'.$style.'">'.$property.'</span>';
                }else{
                    $data['rows'][$i]['cell'][$j] = $property;
                }
                $j++;
            }
            $i++;
        }

        $userData = $this->getUserData();

        if (count($userData) > 0){
            foreach ($userData as $property => $value) {
                $data['userdata'][$property] = $value;
            }
        }
        return Zend_Json::encode($data);
    }

    public function createJS() {
        $js = '';

        $js = '$("#' . $this->getID() . '").jqGrid({';
        foreach ($this->getOptions() as $key => $option) {
            /**
             * Se é um objeto o parâmetro
             * Chame o render desse objeto 
             */
            if ($option instanceof ZendT_JS_Command){
                $js .= $key . ':';
                $js .= $option->render();
                $js .= ', ';
            }else if (is_object($option)) {
                $js .= $key . ':[';
                $js .= $option->render();
                $js .= '], ';
            }
            /**
             * Se é um array monte o js de acordo
             * com o padrão determinado pela documentação do grid 
             */ else if (is_array($option)) {
                /*
                 * Se este array é de eventos
                 * customize o js de acordo com o padrão para eventos
                 */
                if ($key == 'events') {
                    foreach ($this->getEvents() as $nome => $event) {
                        $js .= $nome . ':' . $event . ', ';
                    }
                } else {
                    $js .= $key . ':[';
                    foreach ($option as $value) {
                        if (is_numeric($value)) {
                            $js .= $value . ", ";
                        } else {
                            $js .= "'" . $value . "', ";
                        }
                    }
                    $js = rtrim($js, ', ');
                    $js .= "], ";
                }
            }
            /**
             * Se não for array nem objeto realize a implementação
             * mais simples, o nome do parâmetro e o seu valor 
             */ else {
                if (is_numeric($option)) {
                    $js .= $key . ":" . $option . ", ";
                } else {
                    if ($key == 'postData') {
                        $js .= $key . ":" . $option . ", ";
                    } else {
                        $js .= $key . ":'" . $option . "', ";
                    }
                }
            }
        };
        
        if (count($this->_objects) > 0){
            foreach ($this->_objects as $key=>$option){
                $js .= $key . ':';
                $js .= $option->render();
                $js .= ', ';                
            }
        }

        $js = rtrim($js, ', ');
        $js .= '})';
        
        if ($this->_filterToolbar){
            $js.= '.jqGrid(\'filterToolbar\',{stringResult: false,searchOnEnter: true})';
        }else{
            $js.= '.jqGrid(\'filterToolbar\',{stringResult: false,searchOnEnter: true, showFilter:false})';
        }
        
        if (count($this->_groupHeaders) > 0) {
            $js.= '.jqGrid(\'setGroupHeaders\', {';
            
            if ($this->_useColSpanStyle) {
                $js.= '  useColSpanStyle: true,';
            } else {
                $js.= '  useColSpanStyle: false,';
            }
            
            $groupHeaders = array();
            foreach ($this->_groupHeaders as $column) {
                $groupHeaders[] = "{startColumnName: '".$column['startColumnName']."', numberOfColumns: ".$column['numberOfColumns'].", titleText: '<span style=\"".$column['style']."\">".$column['titleText']."</span>'}";
            }

            $js.= '  groupHeaders:[';
            $js.= implode(',', $groupHeaders);
            $js.= ']})';
        }
        
        $js = str_replace("'true'", "true", $js);

        if ($this->getObjToolbar() instanceof ZendT_Grid_Toolbar) {
            $js .= $this->getObjToolbar()->render();
        }
        $js .= $this->getNavigator()->render();

        $js .= ";";
        $js .= $this->getMethods()->render();        

        $js = '<script type="text/javascript">' .
              '  gGridResizeLoad[\''.$this->getID().'\'] = false; ' .
              '  $(document).ready(function(){' .
                   $js . ';' .
              '  });' .
              '</script>';

        return $js;
    }
    /**
     * Configura se haverá auto filtro
     * 
     * @param bool $value
     * @return \ZendT_Grid 
     */
    public function setAutoFilter($value){
        $this->_filterToolbar = $value;
        return $this;
    }
    
    /**
     * Retorna se o auto filtro esta ligado
     * 
     * @return bool
     */
    public function isAutoFilter(){
        return $this->_filterToolbar;
    }
    
    /**
     *
     * @return type 
     */
    public function render() {
        $this->renderPostData();
        $this->setJS($this->createJS());
        return $this->getHtml() . $this->getJS();
    }
    
    public function __toString() {
        return $this->render();
    }
}
?>
