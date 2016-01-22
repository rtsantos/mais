<?php

/*
 * @category    ZendT
 * @author      jcarlos
 * 
 */

class ZendT_Grid_Column implements ZendT_JS_Interface {

    /**
     * Define o alinhamento do texto dentro da célula do corpo da grid não do cabeçalho.
     * Possíveis valores: left, center, right
     * 
     * @var type string
     * @default left
     */
    private $_align;

    /**
     * Esta função adiciona atributos para a célula durante a criação dos dados
     * Todos os atributos passados para a célula são válidos para uso, ou para estilização com diferentes propriedades
     * Esta função deve retornar uma string e o seus parâmetros são:
     * - rowId -> O id da linha
     * - val -> o valor que será adicionado na célula
     * - rawObject -> O desenho do objeto da linha de dados. Ou seja, se é json é array se é xml é nó de XML
     * - cm -> Todas as propriedades das colunas listadas no colModel
     * - rdata -> os dados que serão inseridos na linha. Este parâmetro é um array do tipo name:value, onde este name é o nome que está no colModel
     * 
     * @var type function
     * @default null
     */
    private $_cellattr;

    /**
     * Esta opção permite adicionar classes para columna.
     * Para adicionar mais de uma classe use espaço para separá-las.
     * Exemplo: 'class1 class2'
     * 
     * No grid há classe já pré-definidas ui-ellipsis que permite atachar estilos para uma determinada linha em particular
     * Funcionará no Firefox também
     * 
     * @var type type string
     * @default empty string
     */
    private $_classes;

    /**
     * Controla o formato de sorttype ( quando o datetype está definido como local )
     * e o editrule como: { date:true }
     * Determina o formato esperado para coluna. Usa o formato de date do PHP-like correntes.
     * 
     * "/", "-" e "." São os separadores de data suportados.
     * Os formatos válidos são:
     * y,Y,yyyy for four digits year
     * YY, yy for two digits year
     * m,mm for months
     * d,dd for days.
     * 
     * Para maiores informações veja Array Data.
     *
     * @var type string
     * @default ISO Date (Y-m-d)
     */
    private $_datefmt;

    /**
     * O valor default para o campo de busca.
     * Esta opção é usada somente quando há uma busca custmizada e será setada como uma busca inicial
     * 
     * @var type string
     * @default empty string
     */
    private $_defval;

    /**
     * Define se o campo é editável.
     * Esta opção é usada na célula, inline e em módulos de formulários. Veja editing
     * 
     * @var type boolean
     * @default false
     */
    private $_editable;

    /**
     * Array de opções permitidas para edição do edittype
     * 
     * @var type array
     * @default empty array
     * @editable
     */
    private $_editoptions;

    /**
     * Seta regras adicionais para edição do campo editável
     * 
     * @var type array
     * @default empty array
     * @editable
     */
    private $_editrules;

    /**
     * Define o tipo de edição para inline ou edição de formulário
     * Valores possíveis: text, textarea, selec, checkbox, password, button, image and file
     * Veja também editing text
     * 
     * @var type string
     * @default text
     */
    private $_edittype;

    /**
     * Se setado como as ou desc, a coluna será sorteada primeiramente nesta ordem setada
     * Subsequentemente o tipo de ordenação será retomado como setado anteriormente
     * 
     * @var type string
     * @default null
     */
    private $_firstsortorder;

    /**
     * Se setada como true a opção não permite o re-cálculo da largura da coluna se shrinkToFit é setado como true
     * Também a largura não é mudad se o método setGridWidth é usada para mudar a largura do width
     * 
     * @var type boolean
     * @default false
     */
    private $_fixed;

    /**
     * Define várias opções para a edição de formulário.
     * Veja Form options
     * 
     * @var type array
     * @default empty options
     */
    private $_formoptions;

    /**
     * Opções de formato consegue ser definido para colunas particulares, sobreescreve as defaults do arquivo de linguagem.
     * Veja Formatter para mais detalhes
     * 
     * @var type array
     * @default none
     */
    private $_formatoptions;

    /**
     * O tipo definido (string) ou um nome de função customizada que controla o formato do campo.
     * Veja Formatter para mais informações.
     * 
     * @var type mixed
     * @default none
     */
    private $_formatter;

    /**
     * Se setado como true, determina que a coluna será congelada depois de chamar o método setFrozenColumns
     * 
     * @var type boolean
     * @default false
     */
    private $_frozen;

    /**
     * Recebe o título da coluna criada em questão
     * 
     * @var type string
     */
    private $_headerTitle;

    /**
     * Se setado como true esta coluna não aparecerá no modal dialog onde os usuários consegue escolher qual coluna será exibida ou não.
     * Veja Show/Hide Columns.
     * 
     * @var type boolean
     * @default false
     */
    private $_hidedlg;

    /**
     * Define se esta coluna é hidden na inicialização
     * Defines if this column is hidden at initialization.
     * 
     * @var type boolean
     * @default false
     */
    private $_hidden;

    /**
     * Seta o nome de identificação para ordenação
     * Passado como parâmetro sidx
     * 
     * @var type string
     * @default empty string
     */
    private $_index;

    /**
     * Recebe as configurações da coluna no formato para
     * ser inserido no grid
     * @var type 
     */
    private $_js;

    /**
     * Define o mapeamento json para a coluna na string de entrada json
     * Veja Retrieving Data
     * 
     * @var type string
     * @default none
     */
    private $_jsonmap;

    /**
     * Neste caso se não há nenhum id no servidor, conseguimos setar um id único para linha.
     * Somente uma coluna consegue ter esta propriedade
     * Se existir mais que uma chave no grid, ele usa a primeira e ignora o resto
     * 
     * @var type boolean
     * @default false
     */
    private $_key;

    /**
     * Quando o array colNames está vazio, é definido um título para esta coluna.
     * Se ambos array colNames e esta configuração estiverem vazias, o título desta coluna vem do nome da propriedade
     * 
     * @var type string
     * @default none
     */
    private $_label;

    /**
     * Seta o único nome no grid para a coluna
     * Esta propriedade é obrigatória.
     * Assim como outras palavras utilizadas como propriedades/eventos e nomes as palavras
     * reservadas não podem ser utilizadas para nomear colunas
     * 
     * @var type string
     * @default Required
     */
    private $_name;

    /**
     * Define se a coluna consegue ser alterada em largura e altura
     * 
     * @var type boolean
     * @default true
     */
    private $_resizable;

    /**
     * Quando usado nos módulos de busca, desabilita ou habilita a busca nesta coluna.
     * Configuração de busca
     * 
     * @var type boolean
     * @default true
     */
    private $_search;

    /**
     * Define as opções de busca usadas em Search Configuration
     * 
     * @var type array
     * @default empty array
     */
    private $_searchoptions;

    /**
     * Define se a coluna consegue ser ordenada
     * 
     * @var type boolean
     * @default true
     */
    private $_sortable;

    /**
     * 
     * Usada quando o tipo de data é local.
     * Defino o tipo de coluna apropriado para ordenação
     * Possíveis valores:
     * - int/integer - para sorteiro de números inteiros
     * - flo
     * - int/integer - para ordenação de inteiros
     * - float/number/currency - para ordenação de números decimais
     * - date - para ordenação de data
     * - text - para ordenação de texto
     * - function - define uma função customizada para ordenação. Esta função
     *   conseguimos passar um valor para ser ordenado e isso deve ser retornado como valor também
     * 
     * Veja Array Data
     * 
     * @var type mixed
     * @default text
     */
    private $_sorttype;

    /**
     * Determina o tipo de elemento quando há uma busca.
     * Veja Search Configuration
     * 
     * @var type string
     * @default text
     */
    private $_stype;

    /**
     * Valido somente em uma busca customizada e edittype : 'select' e descreve
     * a url de onde nós conseguimos resgatar alteready-constructed elemento selecionado
     * 
     * @var type string
     * @default empty string
     */
    private $_surl;

    /**
     * Seta a propriedade válida para o colMode.
     * Esta opção consegue ser usada se você quer sobreescrever muitos valores defaults no modelo da colun de forma fácil.
     * Veja cmTemplate nas opções de grid
     * 
     * @var type object
     * @default null
     */
    private $_template;

    /**
     * Se esta opção é falsa o título não é exibido nesta coluna quando nós passamos o mouse sobre a célula
     * 
     * @var type boolean
     * @default true
     */
    private $_title;

    /**
     * Seta a largura inicial da coluna em pixeis.
     * Este valor não consegue ser setado com porcentagem
     * 
     * @var type number
     * @default 150
     */
    private $_width;

    /**
     * Define o mapeamento de xml para a coluna no xml de entrada
     * Use um específico CCS para esta propriedades
     * Veja Retrieving Data
     * 
     * @var type string
     * @default none
     */
    private $_xmlmap;

    /**
     * Função customizada para 'unformat' um valor da célula quando usada na edição.
     * Veja Custom Formatter. ( Unformat é também chamado durante a operação de ordenação
     * O valor retornado de um unformat é o valor comparado durante a ordenação)
     * 
     * @var type function
     * @default null
     */
    private $_unformat;

    /**
     * Esta opção é válida somente quando o método viewGridRow está ativado
     * QUando a opção está como false a coluna não aparece na view do form
     * 
     * @var type boolean
     * @default true
     */
    private $_viewable;

    /**
     * Máscara que representa o formato da coluna
     * a ser exibido
     * 
     * @var string
     */
    private $_mask;

    /**
     *
     * @var string|ZendT_Db_Mapper
     */
    private $_mapper;
    
    /**
     *
     * @var string
     * @example sum, count
     */
    private $_summaryType;
    
    /**
     * Variavel que contem a lista de opções para ser usado quando stype é check
     * 
     * @var array
     */
    private $_listOptions;
   

    public function __construct() {
        $this->_align = 'left';
    }

    public function getAlign() {
        return $this->_align;
    }

    public function setAlign($align) {
        $this->_align = $align;
        return $this;
    }

    public function getCellattr() {
        return $this->_cellattr;
    }

    public function setCellattr($cellattr) {
        $this->_cellattr = $cellattr;
        return $this;
    }

    public function getClasses() {
        return $this->_classes;
    }

    public function setClasses($classes) {
        $this->_classes = $classes;
        return $this;
    }

    public function getDatefmt() {
        return $this->_datefmt;
    }

    public function setDatefmt($datefmt) {
        $this->_datefmt = $datefmt;
        return $this;
    }

    public function getDefval() {
        return $this->_defval;
    }

    public function setDefval($defval) {
        $this->_defval = $defval;
        return $this;
    }

    public function getEditable() {
        return $this->_editable;
    }

    public function setEditable($editable) {
        $this->_editable = $editable;
        return $this;
    }

    public function getEditoptions() {
        return $this->_editoptions;
    }

    public function setEditoptions($editoptions) {
        if (is_array($editoptions)){
            $_editoptions = '';
            foreach ($editoptions as $key=>$value){
                if ($key){
                    $_editoptions.= ';'.$key.':'.$value;
                }
            }            
            $editoptions = '{'.substr($_editoptions,1).'}';
        }
        $this->_editoptions = $editoptions;
        return $this;
    }

    public function getEditrules() {
        return $this->_editrules;
    }

    public function setEditrules($editrules) {
        $this->_editrules = $editrules;
        return $this;
    }

    public function getEdittype() {
        return $this->_edittype;
    }

    public function setEdittype($edittype) {
        $this->_edittype = $edittype;
        return $this;
    }

    public function getFirstsortorder() {
        return $this->_firstsortorder;
    }

    public function setFirstsortorder($firstsortorder) {
        $this->_firstsortorder = $firstsortorder;
        return $this;
    }

    public function getFixed() {
        return $this->_fixed;
    }

    public function setFixed($fixed) {
        $this->_fixed = $fixed;
        return $this;
    }

    public function getFormoptions() {
        return $this->_formoptions;
    }

    public function setFormoptions($formoptions) {
        $this->_formoptions = $formoptions;
        return $this;
    }

    public function getFormatoptions() {
        return $this->_formatoptions;
    }

    public function setFormatoptions($formatoptions) {
        $this->_formatoptions = $formatoptions;
        return $this;
    }

    public function getFormatter() {
        return $this->_formatter;
    }

    public function setFormatter($formatter) {
        $this->_formatter = $formatter;
        return $this;
    }

    public function getFrozen() {
        return $this->_frozen;
    }

    public function setFrozen($frozen) {
        $this->_frozen = $frozen;
        return $this;
    }

    public function getHeaderTitle() {
        return $this->_headerTitle;
    }

    public function setHeaderTitle($headerTitle) {
        $this->_headerTitle = $headerTitle;
        return $this;
    }

    public function getHidedlg() {
        return $this->_hidedlg;
    }

    public function setHidedlg($hidedlg) {
        $this->_hidedlg = $hidedlg;
        return $this;
    }

    public function getHidden() {
        return $this->_hidden;
    }

    public function setHidden($hidden) {
        $this->_hidden = $hidden;
        return $this;
    }

    public function getIndex() {
        return $this->_index;
    }

    public function setIndex($index) {
        $this->_index = $index;
        return $this;
    }

    /**
     *
     * @param string $index
     * @return \ZendT_Grid_Column 
     */
    public function setTableAndFieldName($index) {
        $this->setIndex($index);
        return $this;
    }

    /**
     * 
     * @return string 
     */
    public function getTableAndFieldName() {
        return $this->getIndex();
    }

    /**
     * Configura o nome do Mapper
     * usado para formatar o dado da coluna
     * 
     * @param string  $value
     * @return \ZendT_Grid_Column 
     */
    public function setMapperName($value) {
        $this->_mapper = $value;
        return $this;
    }

    /**
     * Configura o objeto de Mapper
     * usado para formatar o dado da coluna
     * 
     * @param ZendT_Db_Mapper $value
     * @return \ZendT_Grid_Column 
     */
    public function setMapper($value) {
        $this->_mapper = $value;
        return $this;
    }

    /**
     * Retorna o nome do Mapper
     * 
     * @return string
     */
    public function getMapperName() {
        return $this->_mapper;
    }

    public function getJS() {
        return $this->_js;
    }

    public function setJS($js) {
        $this->_js = $js;
        return $this;
    }

    public function getJsonmap() {
        return $this->_jsonmap;
    }

    public function setJsonmap($jsonmap) {
        $this->_jsonmap = $jsonmap;
        return $this;
    }

    public function getKey() {
        return $this->_key;
    }

    public function setKey($key) {
        $this->_key = $key;
        return $this;
    }

    public function getLabel() {
        return $this->_label;
    }

    public function setLabel($label) {
        $this->_label = $label;
        return $this;
    }

    public function getName() {
        return $this->_name;
    }

    public function setName($name) {
        $this->_name = $name;
        return $this;
    }

    public function getResizable() {
        return $this->_resizable;
    }

    public function setResizable($resizable) {
        $this->_resizable = $resizable;
        return $this;
    }

    public function getSearch() {
        return $this->_search;
    }

    public function setSearch($search) {
        $this->_search = $search;
        return $this;
    }

    public function getSearchoptions() {
        return $this->_searchoptions;
    }

    public function setSearchoptions($searchoptions) {
        $this->_searchoptions = $searchoptions;
        return $this;
    }

    public function getSortable() {
        return $this->_sortable;
    }

    public function setSortable($sortable) {
        $this->_sortable = $sortable;
        return $this;
    }

    public function getSorttype() {
        return $this->_sorttype;
    }

    public function setSorttype($sorttype) {
        $this->_sorttype = $sorttype;
        return $this;
    }

    public function getType() {
        return $this->getSorttype();
    }

    public function setType($sorttype) {
        $this->setSorttype($sorttype);
        return $this;
    }

    public function getStype() {
        return $this->_stype;
    }

    public function setStype($stype) {
        $this->_stype = $stype;
        return $this;
    }

    public function getSurl() {
        return $this->_surl;
    }

    public function setSurl($surl) {
        $this->_surl = $surl;
        return $this;
    }

    public function getTemplate() {
        return $this->_template;
    }

    public function setTemplate($template) {
        $this->_template = $template;
        return $this;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function setTitle($title) {
        $this->_title = $title;
        return $this;
    }

    public function getWidth() {
        return $this->_width;
    }

    public function setWidth($width) {
        $this->_width = $width;
        return $this;
    }

    public function getXmlmap() {
        return $this->_xmlmap;
    }

    public function setXmlmap($xmlmap) {
        $this->_xmlmap = $xmlmap;
        return $this;
    }

    public function getUnformat() {
        return $this->_unformat;
    }

    public function setUnformat($unformat) {
        $this->_unformat = $unformat;
        return $this;
    }

    public function getViewable() {
        return $this->_viewable;
    }

    public function setViewable($viewable) {
        $this->_viewable = $viewable;
        return $this;
    }
    
    /**
     * Recebe um array para criar a lista de opções que será usado no autofiltro quando o stype é check
     * 
     * @param array $options
     * @return \ZendT_Grid_Column 
     */
    public function setListOptions(array $options){
        if (count($options) > 0){
            foreach($options as $key => $value){
                if($value != ''){
                    $this->_listOptions[$key] = $value;
                }
            }
        }else{
            $this->_listOptions = $options;
        }
        return $this;
    }
    
    /**
     * Retorna um array com a lista de opções a serem usadas no autofiltro
     * 
     * @return array 
     */
    public function getListOptions(){
        return $this->_listOptions;
    }

    /**
     * Configura uma máscara para o dado a ser exibido na coluna
     * 
     * @param string $value
     * @return \ZendT_Grid_Column 
     */
    public function setMask($value) {
        $this->_mask = $value;
        return $this;
    }

    /**
     * Retorna a formatação do dado, representado na coluna
     * 
     * @return string
     */
    public function getMask() {
        return $this->_mask;
    }
    /**
     *
     * @param string $summaryType 
     * @example sum,count
     * @return \ZendT_Grid_Column 
     */
    public function setSummaryType($summaryType){
        $this->_summaryType = $summaryType;
        return $this;
    }
    /**
     *
     * @return string
     */
    public function getSummaryType(){
        return $this->_summaryType;
    }
    /**
     *
     * @param array $options
     * @return \ZendT_Grid_Column 
     */
    public function setOptions($options){
        $this->_options = $options;
        return $this;
    }
    /**
     * Retorna as opções particulares da coluna
     *
     * @return array
     */
    public function getOptions(){
        return $this->_options;
    }
    /**
     * Gero das propriedades desta classe um array
     * Trato as chaves desta propriedade retirando o '_' da frente
     * para que o jqGrid aceite os parâmetros
     * 
     * @return type json
     */
    public function createJS() {

        $propertys = get_object_vars($this);

        foreach ($propertys as $key => $property) {
            //Crio a nova chave sem '_'
            $newKey = substr($key, 1);

            //Crio os novos elementos com as novas chaves geradas
            $propertys[$newKey] = $propertys[$key];
            unset($propertys[$key]);

            //Retiro do array todas a propriedades que estão com o valor nulo
            if (is_null($property)) {
                unset($propertys[$newKey]);
            }
        }

        return ZendX_JQuery::encodeJson($propertys);
    }

    public function render() {
        $this->setJS($this->createJS());
        return $this->getJS();
    }

    /**
     * Formata um dado de acordo com o tipo e a máscara definido
     * que será apresentado para o usuário
     *
     * @param string $value
     * @param string $format
     * @param string $locale
     * @return string
     */
    public function format($value, $format = null, $locale = null) {
        if ($format === null) {
            $format = $this->_mask;
        }

        if (!is_object($this->_mapper)) {
            if ($this->_mapper != '') {
                $this->_mapper = new $this->_mapper();
            }
        }
        if (is_object($this->_mapper)) {
            $columnName = substr($this->_index, strpos($this->_index, '.') + 1);
            return $this->_mapper->format($value, $columnName, $format, $locale);
        } else {
            $type = $this->getType();
            if ($type == 'Number' || $type == 'Numeric' || $type == 'Integer') {
                return ZendT_Type_Number::fromIso($value, $locale)->get($format);
            } else if ($type == 'Date' || $type == 'DateTime') {
                if ($format == '' || $format === null) {
                    if ($type == 'Date') {
                        $format = 'dd/MM/YYYY';
                    } else {
                        $format = 'dd/MM/YYYY HH:mm:s';
                    }
                }
                return ZendT_Type_Date::fromIso($value, $locale)->get($format);
            } else {
                if ($this->_mask) {
                    return ZendT_Format::string($value, $this->_mask);
                } else {
                    return $value;
                }
            }
        }
    }

}

?>
