<?php

/** PHPExcel root directory */
if (!defined('PHPEXCEL_ROOT')) {
    /**
     * @ignore
     */
    define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../');
    require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}

if (!defined('CALCULATION_REGEXP_CELLREF')) {
    //    Test for support of \P (multibyte options) in PCRE
    if (defined('PREG_BAD_UTF8_ERROR')) {
        //    Cell reference (cell or range of cells, with or without a sheet reference)
        define('CALCULATION_REGEXP_CELLREF', '((([^\s,!&%^\/\*\+<>=-]*)|(\'[^\']*\')|(\"[^\"]*\"))!)?\$?([a-z]{1,3})\$?(\d{1,7})');
        //    Named Range of cells
        define('CALCULATION_REGEXP_NAMEDRANGE', '((([^\s,!&%^\/\*\+<>=-]*)|(\'[^\']*\')|(\"[^\"]*\"))!)?([_A-Z][_A-Z0-9\.]*)');
    } else {
        //    Cell reference (cell or range of cells, with or without a sheet reference)
        define('CALCULATION_REGEXP_CELLREF', '(((\w*)|(\'[^\']*\')|(\"[^\"]*\"))!)?\$?([a-z]{1,3})\$?(\d+)');
        //    Named Range of cells
        define('CALCULATION_REGEXP_NAMEDRANGE', '(((\w*)|(\'.*\')|(\".*\"))!)?([_A-Z][_A-Z0-9\.]*)');
    }
}

/**
 * PHPExcel_Calculation (Multiton)
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_Calculation
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExcel_Calculation
{
    /** Constants                */
    /** Regular Expressions        */
    //    Numeric operand
    const CALCULATION_REGEXP_NUMBER        = '[-+]?\d*\.?\d+(e[-+]?\d+)?';
    //    String operand
    const CALCULATION_REGEXP_STRING        = '"(?:[^"]|"")*"';
    //    Opening bracket
    const CALCULATION_REGEXP_OPENBRACE    = '\(';
    //    Function (allow for the old @ symbol that could be used to prefix a function, but we'll ignore it)
    const CALCULATION_REGEXP_FUNCTION    = '@?([A-Z][A-Z0-9\.]*)[\s]*\(';
    //    Cell reference (cell or range of cells, with or without a sheet reference)
    const CALCULATION_REGEXP_CELLREF    = CALCULATION_REGEXP_CELLREF;
    //    Named Range of cells
    const CALCULATION_REGEXP_NAMEDRANGE    = CALCULATION_REGEXP_NAMEDRANGE;
    //    Error
    const CALCULATION_REGEXP_ERROR        = '\#[A-Z][A-Z0_\/]*[!\?]?';


    /** constants */
    const RETURN_ARRAY_AS_ERROR = 'error';
    const RETURN_ARRAY_AS_VALUE = 'value';
    const RETURN_ARRAY_AS_ARRAY = 'array';

    private static $returnArrayAsType = self::RETURN_ARRAY_AS_VALUE;


    /**
     * Instance of this class
     *
     * @access    private
     * @var PHPExcel_Calculation
     */
    private static $instance;


    /**
     * Instance of the workbook this Calculation Engine is using
     *
     * @access    private
     * @var PHPExcel
     */
    private $workbook;

    /**
     * List of instances of the calculation engine that we've instantiated for individual workbooks
     *
     * @access    private
     * @var PHPExcel_Calculation[]
     */
    private static $workbookSets;

    /**
     * Calculation cache
     *
     * @access    private
     * @var array
     */
    private $calculationCache = array ();


    /**
     * Calculation cache enabled
     *
     * @access    private
     * @var boolean
     */
    private $calculationCacheEnabled = true;


    /**
     * List of operators that can be used within formulae
     * The true/false value indicates whether it is a binary operator or a unary operator
     *
     * @access    private
     * @var array
     */
    private static $operators = array(
        '+' => true,    '-' => true,    '*' => true,    '/' => true,
        '^' => true,    '&' => true,    '%' => false,    '~' => false,
        '>' => true,    '<' => true,    '=' => true,    '>=' => true,
        '<=' => true,    '<>' => true,    '|' => true,    ':' => true
    );

    /**
     * List of binary operators (those that expect two operands)
     *
     * @access    private
     * @var array
     */
    private static $binaryOperators = array(
        '+' => true,    '-' => true,    '*' => true,    '/' => true,
        '^' => true,    '&' => true,    '>' => true,    '<' => true,
        '=' => true,    '>=' => true,    '<=' => true,    '<>' => true,
        '|' => true,    ':' => true
    );

    /**
     * The debug log generated by the calculation engine
     *
     * @access    private
     * @var PHPExcel_CalcEngine_Logger
     *
     */
    private $debugLog;

    /**
     * Flag to determine how formula errors should be handled
     *        If true, then a user error will be triggered
     *        If false, then an exception will be thrown
     *
     * @access    public
     * @var boolean
     *
     */
    public $suppressFormulaErrors = false;

    /**
     * Error message for any error that was raised/thrown by the calculation engine
     *
     * @access    public
     * @var string
     *
     */
    public $formulaError = null;

    /**
     * An array of the nested cell references accessed by the calculation engine, used for the debug log
     *
     * @access    private
     * @var array of string
     *
     */
    private $cyclicReferenceStack;

    private $cellStack = array();

    /**
     * Current iteration counter for cyclic formulae
     * If the value is 0 (or less) then cyclic formulae will throw an exception,
     *    otherwise they will iterate to the limit defined here before returning a result
     *
     * @var integer
     *
     */
    private $cyclicFormulaCounter = 1;

    private $cyclicFormulaCell = '';

    /**
     * Number of iterations for cyclic formulae
     *
     * @var integer
     *
     */
    public $cyclicFormulaCount = 1;

    /**
     * Epsilon Precision used for comparisons in calculations
     *
     * @var float
     *
     */
    private $delta    = 0.1e-12;


    /**
     * The current locale setting
     *
     * @var string
     *
     */
    private static $localeLanguage = 'en_us';                    //    US English    (default locale)

    /**
     * List of available locale settings
     * Note that this is read for the locale subdirectory only when requested
     *
     * @var string[]
     *
     */
    private static $validLocaleLanguages = array(
        'en'        //    English        (default language)
    );

    /**
     * Locale-specific argument separator for function arguments
     *
     * @var string
     *
     */
    private static $localeArgumentSeparator = ',';
    private static $localeFunctions = array();

    /**
     * Locale-specific translations for Excel constants (True, False and Null)
     *
     * @var string[]
     *
     */
    public static $localeBoolean = array(
        'TRUE'  => 'TRUE',
        'FALSE' => 'FALSE',
        'NULL'  => 'NULL'
    );

    /**
     * Excel constant string translations to their PHP equivalents
     * Constant conversion from text name/value to actual (datatyped) value
     *
     * @var string[]
     *
     */
    private static $excelConstants = array(
        'TRUE'  => true,
        'FALSE' => false,
        'NULL'  => null
    );

     //    PHPExcel functions
    private static $PHPExcelFunctions = array(
        'ABS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'abs',
            'argumentCount' => '1'
        ),
        'ACCRINT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::ACCRINT',
            'argumentCount' => '4-7'
        ),
        'ACCRINTM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::ACCRINTM',
            'argumentCount' => '3-5'
        ),
        'ACOS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'acos',
            'argumentCount' => '1'
        ),
        'ACOSH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'acosh',
            'argumentCount' => '1'
        ),
        'ADDRESS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::CELL_ADDRESS',
            'argumentCount' => '2-5'
        ),
        'AMORDEGRC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::AMORDEGRC',
            'argumentCount' => '6,7'
        ),
        'AMORLINC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::AMORLINC',
            'argumentCount' => '6,7'
        ),
        'AND' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOGICAL,
            'functionCall' => 'PHPExcel_Calculation_Logical::LOGICAL_AND',
            'argumentCount' => '1+'
        ),
        'AREAS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1'
        ),
        'ASC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1'
        ),
        'ASIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'asin',
            'argumentCount' => '1'
        ),
        'ASINH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'asinh',
            'argumentCount' => '1'
        ),
        'ATAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'atan',
            'argumentCount' => '1'
        ),
        'ATAN2' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::ATAN2',
            'argumentCount' => '2'
        ),
        'ATANH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'atanh',
            'argumentCount' => '1'
        ),
        'AVEDEV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::AVEDEV',
            'argumentCount' => '1+'
        ),
        'AVERAGE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::AVERAGE',
            'argumentCount' => '1+'
        ),
        'AVERAGEA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::AVERAGEA',
            'argumentCount' => '1+'
        ),
        'AVERAGEIF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::AVERAGEIF',
            'argumentCount' => '2,3'
        ),
        'AVERAGEIFS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '3+'
        ),
        'BAHTTEXT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1'
        ),
        'BESSELI' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::BESSELI',
            'argumentCount' => '2'
        ),
        'BESSELJ' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::BESSELJ',
            'argumentCount' => '2'
        ),
        'BESSELK' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::BESSELK',
            'argumentCount' => '2'
        ),
        'BESSELY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::BESSELY',
            'argumentCount' => '2'
        ),
        'BETADIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::BETADIST',
            'argumentCount' => '3-5'
        ),
        'BETAINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::BETAINV',
            'argumentCount' => '3-5'
        ),
        'BIN2DEC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::BINTODEC',
            'argumentCount' => '1'
        ),
        'BIN2HEX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::BINTOHEX',
            'argumentCount' => '1,2'
        ),
        'BIN2OCT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::BINTOOCT',
            'argumentCount' => '1,2'
        ),
        'BINOMDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::BINOMDIST',
            'argumentCount' => '4'
        ),
        'CEILING' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::CEILING',
            'argumentCount' => '2'
        ),
        'CELL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1,2'
        ),
        'CHAR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::CHARACTER',
            'argumentCount' => '1'
        ),
        'CHIDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::CHIDIST',
            'argumentCount' => '2'
        ),
        'CHIINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::CHIINV',
            'argumentCount' => '2'
        ),
        'CHITEST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2'
        ),
        'CHOOSE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::CHOOSE',
            'argumentCount' => '2+'
        ),
        'CLEAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::TRIMNONPRINTABLE',
            'argumentCount' => '1'
        ),
        'CODE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::ASCIICODE',
            'argumentCount' => '1'
        ),
        'COLUMN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::COLUMN',
            'argumentCount' => '-1',
            'passByReference' => array(true)
        ),
        'COLUMNS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::COLUMNS',
            'argumentCount' => '1'
        ),
        'COMBIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::COMBIN',
            'argumentCount' => '2'
        ),
        'COMPLEX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::COMPLEX',
            'argumentCount' => '2,3'
        ),
        'CONCATENATE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::CONCATENATE',
            'argumentCount' => '1+'
        ),
        'CONFIDENCE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::CONFIDENCE',
            'argumentCount' => '3'
        ),
        'CONVERT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::CONVERTUOM',
            'argumentCount' => '3'
        ),
        'CORREL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::CORREL',
            'argumentCount' => '2'
        ),
        'COS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'cos',
            'argumentCount' => '1'
        ),
        'COSH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'cosh',
            'argumentCount' => '1'
        ),
        'COUNT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::COUNT',
            'argumentCount' => '1+'
        ),
        'COUNTA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::COUNTA',
            'argumentCount' => '1+'
        ),
        'COUNTBLANK' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::COUNTBLANK',
            'argumentCount' => '1'
        ),
        'COUNTIF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::COUNTIF',
            'argumentCount' => '2'
        ),
        'COUNTIFS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2'
        ),
        'COUPDAYBS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::COUPDAYBS',
            'argumentCount' => '3,4'
        ),
        'COUPDAYS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::COUPDAYS',
            'argumentCount' => '3,4'
        ),
        'COUPDAYSNC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::COUPDAYSNC',
            'argumentCount' => '3,4'
        ),
        'COUPNCD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::COUPNCD',
            'argumentCount' => '3,4'
        ),
        'COUPNUM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::COUPNUM',
            'argumentCount' => '3,4'
        ),
        'COUPPCD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::COUPPCD',
            'argumentCount' => '3,4'
        ),
        'COVAR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::COVAR',
            'argumentCount' => '2'
        ),
        'CRITBINOM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::CRITBINOM',
            'argumentCount' => '3'
        ),
        'CUBEKPIMEMBER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_CUBE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '?'
        ),
        'CUBEMEMBER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_CUBE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '?'
        ),
        'CUBEMEMBERPROPERTY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_CUBE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '?'
        ),
        'CUBERANKEDMEMBER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_CUBE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '?'
        ),
        'CUBESET' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_CUBE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '?'
        ),
        'CUBESETCOUNT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_CUBE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '?'
        ),
        'CUBEVALUE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_CUBE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '?'
        ),
        'CUMIPMT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::CUMIPMT',
            'argumentCount' => '6'
        ),
        'CUMPRINC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::CUMPRINC',
            'argumentCount' => '6'
        ),
        'DATE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DATE',
            'argumentCount' => '3'
        ),
        'DATEDIF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DATEDIF',
            'argumentCount' => '2,3'
        ),
        'DATEVALUE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DATEVALUE',
            'argumentCount' => '1'
        ),
        'DAVERAGE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DAVERAGE',
            'argumentCount' => '3'
        ),
        'DAY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DAYOFMONTH',
            'argumentCount' => '1'
        ),
        'DAYS360' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DAYS360',
            'argumentCount' => '2,3'
        ),
        'DB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::DB',
            'argumentCount' => '4,5'
        ),
        'DCOUNT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DCOUNT',
            'argumentCount' => '3'
        ),
        'DCOUNTA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DCOUNTA',
            'argumentCount' => '3'
        ),
        'DDB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::DDB',
            'argumentCount' => '4,5'
        ),
        'DEC2BIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::DECTOBIN',
            'argumentCount' => '1,2'
        ),
        'DEC2HEX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::DECTOHEX',
            'argumentCount' => '1,2'
        ),
        'DEC2OCT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::DECTOOCT',
            'argumentCount' => '1,2'
        ),
        'DEGREES' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'rad2deg',
            'argumentCount' => '1'
        ),
        'DELTA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::DELTA',
            'argumentCount' => '1,2'
        ),
        'DEVSQ' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::DEVSQ',
            'argumentCount' => '1+'
        ),
        'DGET' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DGET',
            'argumentCount' => '3'
        ),
        'DISC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::DISC',
            'argumentCount' => '4,5'
        ),
        'DMAX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DMAX',
            'argumentCount' => '3'
        ),
        'DMIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DMIN',
            'argumentCount' => '3'
        ),
        'DOLLAR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::DOLLAR',
            'argumentCount' => '1,2'
        ),
        'DOLLARDE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::DOLLARDE',
            'argumentCount' => '2'
        ),
        'DOLLARFR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::DOLLARFR',
            'argumentCount' => '2'
        ),
        'DPRODUCT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DPRODUCT',
            'argumentCount' => '3'
        ),
        'DSTDEV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DSTDEV',
            'argumentCount' => '3'
        ),
        'DSTDEVP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DSTDEVP',
            'argumentCount' => '3'
        ),
        'DSUM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DSUM',
            'argumentCount' => '3'
        ),
        'DURATION' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '5,6'
        ),
        'DVAR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DVAR',
            'argumentCount' => '3'
        ),
        'DVARP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATABASE,
            'functionCall' => 'PHPExcel_Calculation_Database::DVARP',
            'argumentCount' => '3'
        ),
        'EDATE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::EDATE',
            'argumentCount' => '2'
        ),
        'EFFECT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::EFFECT',
            'argumentCount' => '2'
        ),
        'EOMONTH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::EOMONTH',
            'argumentCount' => '2'
        ),
        'ERF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::ERF',
            'argumentCount' => '1,2'
        ),
        'ERFC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::ERFC',
            'argumentCount' => '1'
        ),
        'ERROR.TYPE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::ERROR_TYPE',
            'argumentCount' => '1'
        ),
        'EVEN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::EVEN',
            'argumentCount' => '1'
        ),
        'EXACT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2'
        ),
        'EXP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'exp',
            'argumentCount' => '1'
        ),
        'EXPONDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::EXPONDIST',
            'argumentCount' => '3'
        ),
        'FACT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::FACT',
            'argumentCount' => '1'
        ),
        'FACTDOUBLE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::FACTDOUBLE',
            'argumentCount' => '1'
        ),
        'FALSE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOGICAL,
            'functionCall' => 'PHPExcel_Calculation_Logical::FALSE',
            'argumentCount' => '0'
        ),
        'FDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '3'
        ),
        'FIND' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::SEARCHSENSITIVE',
            'argumentCount' => '2,3'
        ),
        'FINDB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::SEARCHSENSITIVE',
            'argumentCount' => '2,3'
        ),
        'FINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '3'
        ),
        'FISHER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::FISHER',
            'argumentCount' => '1'
        ),
        'FISHERINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::FISHERINV',
            'argumentCount' => '1'
        ),
        'FIXED' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::FIXEDFORMAT',
            'argumentCount' => '1-3'
        ),
        'FLOOR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::FLOOR',
            'argumentCount' => '2'
        ),
        'FORECAST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::FORECAST',
            'argumentCount' => '3'
        ),
        'FREQUENCY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2'
        ),
        'FTEST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2'
        ),
        'FV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::FV',
            'argumentCount' => '3-5'
        ),
        'FVSCHEDULE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::FVSCHEDULE',
            'argumentCount' => '2'
        ),
        'GAMMADIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::GAMMADIST',
            'argumentCount' => '4'
        ),
        'GAMMAINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::GAMMAINV',
            'argumentCount' => '3'
        ),
        'GAMMALN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::GAMMALN',
            'argumentCount' => '1'
        ),
        'GCD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::GCD',
            'argumentCount' => '1+'
        ),
        'GEOMEAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::GEOMEAN',
            'argumentCount' => '1+'
        ),
        'GESTEP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::GESTEP',
            'argumentCount' => '1,2'
        ),
        'GETPIVOTDATA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2+'
        ),
        'GROWTH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::GROWTH',
            'argumentCount' => '1-4'
        ),
        'HARMEAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::HARMEAN',
            'argumentCount' => '1+'
        ),
        'HEX2BIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::HEXTOBIN',
            'argumentCount' => '1,2'
        ),
        'HEX2DEC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::HEXTODEC',
            'argumentCount' => '1'
        ),
        'HEX2OCT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::HEXTOOCT',
            'argumentCount' => '1,2'
        ),
        'HLOOKUP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::HLOOKUP',
            'argumentCount' => '3,4'
        ),
        'HOUR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::HOUROFDAY',
            'argumentCount' => '1'
        ),
        'HYPERLINK' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::HYPERLINK',
            'argumentCount' => '1,2',
            'passCellReference' => true
        ),
        'HYPGEOMDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::HYPGEOMDIST',
            'argumentCount' => '4'
        ),
        'IF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOGICAL,
            'functionCall' => 'PHPExcel_Calculation_Logical::STATEMENT_IF',
            'argumentCount' => '1-3'
        ),
        'IFERROR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOGICAL,
            'functionCall' => 'PHPExcel_Calculation_Logical::IFERROR',
            'argumentCount' => '2'
        ),
        'IMABS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMABS',
            'argumentCount' => '1'
        ),
        'IMAGINARY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMAGINARY',
            'argumentCount' => '1'
        ),
        'IMARGUMENT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMARGUMENT',
            'argumentCount' => '1'
        ),
        'IMCONJUGATE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMCONJUGATE',
            'argumentCount' => '1'
        ),
        'IMCOS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMCOS',
            'argumentCount' => '1'
        ),
        'IMDIV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMDIV',
            'argumentCount' => '2'
        ),
        'IMEXP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMEXP',
            'argumentCount' => '1'
        ),
        'IMLN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMLN',
            'argumentCount' => '1'
        ),
        'IMLOG10' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMLOG10',
            'argumentCount' => '1'
        ),
        'IMLOG2' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMLOG2',
            'argumentCount' => '1'
        ),
        'IMPOWER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMPOWER',
            'argumentCount' => '2'
        ),
        'IMPRODUCT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMPRODUCT',
            'argumentCount' => '1+'
        ),
        'IMREAL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMREAL',
            'argumentCount' => '1'
        ),
        'IMSIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMSIN',
            'argumentCount' => '1'
        ),
        'IMSQRT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMSQRT',
            'argumentCount' => '1'
        ),
        'IMSUB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMSUB',
            'argumentCount' => '2'
        ),
        'IMSUM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::IMSUM',
            'argumentCount' => '1+'
        ),
        'INDEX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::INDEX',
            'argumentCount' => '1-4'
        ),
        'INDIRECT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::INDIRECT',
            'argumentCount' => '1,2',
            'passCellReference' => true
        ),
        'INFO' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1'
        ),
        'INT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::INT',
            'argumentCount' => '1'
        ),
        'INTERCEPT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::INTERCEPT',
            'argumentCount' => '2'
        ),
        'INTRATE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::INTRATE',
            'argumentCount' => '4,5'
        ),
        'IPMT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::IPMT',
            'argumentCount' => '4-6'
        ),
        'IRR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::IRR',
            'argumentCount' => '1,2'
        ),
        'ISBLANK' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_BLANK',
            'argumentCount' => '1'
        ),
        'ISERR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_ERR',
            'argumentCount' => '1'
        ),
        'ISERROR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_ERROR',
            'argumentCount' => '1'
        ),
        'ISEVEN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_EVEN',
            'argumentCount' => '1'
        ),
        'ISLOGICAL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_LOGICAL',
            'argumentCount' => '1'
        ),
        'ISNA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_NA',
            'argumentCount' => '1'
        ),
        'ISNONTEXT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_NONTEXT',
            'argumentCount' => '1'
        ),
        'ISNUMBER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_NUMBER',
            'argumentCount' => '1'
        ),
        'ISODD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_ODD',
            'argumentCount' => '1'
        ),
        'ISPMT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::ISPMT',
            'argumentCount' => '4'
        ),
        'ISREF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1'
        ),
        'ISTEXT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::IS_TEXT',
            'argumentCount' => '1'
        ),
        'JIS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1'
        ),
        'KURT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::KURT',
            'argumentCount' => '1+'
        ),
        'LARGE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::LARGE',
            'argumentCount' => '2'
        ),
        'LCM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::LCM',
            'argumentCount' => '1+'
        ),
        'LEFT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::LEFT',
            'argumentCount' => '1,2'
        ),
        'LEFTB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::LEFT',
            'argumentCount' => '1,2'
        ),
        'LEN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::STRINGLENGTH',
            'argumentCount' => '1'
        ),
        'LENB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::STRINGLENGTH',
            'argumentCount' => '1'
        ),
        'LINEST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::LINEST',
            'argumentCount' => '1-4'
        ),
        'LN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'log',
            'argumentCount' => '1'
        ),
        'LOG' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::LOG_BASE',
            'argumentCount' => '1,2'
        ),
        'LOG10' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'log10',
            'argumentCount' => '1'
        ),
        'LOGEST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::LOGEST',
            'argumentCount' => '1-4'
        ),
        'LOGINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::LOGINV',
            'argumentCount' => '3'
        ),
        'LOGNORMDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::LOGNORMDIST',
            'argumentCount' => '3'
        ),
        'LOOKUP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::LOOKUP',
            'argumentCount' => '2,3'
        ),
        'LOWER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::LOWERCASE',
            'argumentCount' => '1'
        ),
        'MATCH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::MATCH',
            'argumentCount' => '2,3'
        ),
        'MAX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MAX',
            'argumentCount' => '1+'
        ),
        'MAXA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MAXA',
            'argumentCount' => '1+'
        ),
        'MAXIF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MAXIF',
            'argumentCount' => '2+'
        ),
        'MDETERM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::MDETERM',
            'argumentCount' => '1'
        ),
        'MDURATION' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '5,6'
        ),
        'MEDIAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MEDIAN',
            'argumentCount' => '1+'
        ),
        'MEDIANIF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2+'
        ),
        'MID' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::MID',
            'argumentCount' => '3'
        ),
        'MIDB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::MID',
            'argumentCount' => '3'
        ),
        'MIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MIN',
            'argumentCount' => '1+'
        ),
        'MINA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MINA',
            'argumentCount' => '1+'
        ),
        'MINIF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MINIF',
            'argumentCount' => '2+'
        ),
        'MINUTE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::MINUTEOFHOUR',
            'argumentCount' => '1'
        ),
        'MINVERSE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::MINVERSE',
            'argumentCount' => '1'
        ),
        'MIRR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::MIRR',
            'argumentCount' => '3'
        ),
        'MMULT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::MMULT',
            'argumentCount' => '2'
        ),
        'MOD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::MOD',
            'argumentCount' => '2'
        ),
        'MODE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::MODE',
            'argumentCount' => '1+'
        ),
        'MONTH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::MONTHOFYEAR',
            'argumentCount' => '1'
        ),
        'MROUND' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::MROUND',
            'argumentCount' => '2'
        ),
        'MULTINOMIAL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::MULTINOMIAL',
            'argumentCount' => '1+'
        ),
        'N' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::N',
            'argumentCount' => '1'
        ),
        'NA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::NA',
            'argumentCount' => '0'
        ),
        'NEGBINOMDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::NEGBINOMDIST',
            'argumentCount' => '3'
        ),
        'NETWORKDAYS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::NETWORKDAYS',
            'argumentCount' => '2+'
        ),
        'NOMINAL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::NOMINAL',
            'argumentCount' => '2'
        ),
        'NORMDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::NORMDIST',
            'argumentCount' => '4'
        ),
        'NORMINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::NORMINV',
            'argumentCount' => '3'
        ),
        'NORMSDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::NORMSDIST',
            'argumentCount' => '1'
        ),
        'NORMSINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::NORMSINV',
            'argumentCount' => '1'
        ),
        'NOT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOGICAL,
            'functionCall' => 'PHPExcel_Calculation_Logical::NOT',
            'argumentCount' => '1'
        ),
        'NOW' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DATETIMENOW',
            'argumentCount' => '0'
        ),
        'NPER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::NPER',
            'argumentCount' => '3-5'
        ),
        'NPV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::NPV',
            'argumentCount' => '2+'
        ),
        'OCT2BIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::OCTTOBIN',
            'argumentCount' => '1,2'
        ),
        'OCT2DEC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::OCTTODEC',
            'argumentCount' => '1'
        ),
        'OCT2HEX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_ENGINEERING,
            'functionCall' => 'PHPExcel_Calculation_Engineering::OCTTOHEX',
            'argumentCount' => '1,2'
        ),
        'ODD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::ODD',
            'argumentCount' => '1'
        ),
        'ODDFPRICE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '8,9'
        ),
        'ODDFYIELD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '8,9'
        ),
        'ODDLPRICE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '7,8'
        ),
        'ODDLYIELD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '7,8'
        ),
        'OFFSET' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::OFFSET',
            'argumentCount' => '3-5',
            'passCellReference' => true,
            'passByReference' => array(true)
        ),
        'OR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOGICAL,
            'functionCall' => 'PHPExcel_Calculation_Logical::LOGICAL_OR',
            'argumentCount' => '1+'
        ),
        'PEARSON' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::CORREL',
            'argumentCount' => '2'
        ),
        'PERCENTILE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::PERCENTILE',
            'argumentCount' => '2'
        ),
        'PERCENTRANK' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::PERCENTRANK',
            'argumentCount' => '2,3'
        ),
        'PERMUT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::PERMUT',
            'argumentCount' => '2'
        ),
        'PHONETIC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1'
        ),
        'PI' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'pi',
            'argumentCount' => '0'
        ),
        'PMT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::PMT',
            'argumentCount' => '3-5'
        ),
        'POISSON' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::POISSON',
            'argumentCount' => '3'
        ),
        'POWER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::POWER',
            'argumentCount' => '2'
        ),
        'PPMT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::PPMT',
            'argumentCount' => '4-6'
        ),
        'PRICE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::PRICE',
            'argumentCount' => '6,7'
        ),
        'PRICEDISC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::PRICEDISC',
            'argumentCount' => '4,5'
        ),
        'PRICEMAT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::PRICEMAT',
            'argumentCount' => '5,6'
        ),
        'PROB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '3,4'
        ),
        'PRODUCT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::PRODUCT',
            'argumentCount' => '1+'
        ),
        'PROPER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::PROPERCASE',
            'argumentCount' => '1'
        ),
        'PV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::PV',
            'argumentCount' => '3-5'
        ),
        'QUARTILE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::QUARTILE',
            'argumentCount' => '2'
        ),
        'QUOTIENT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::QUOTIENT',
            'argumentCount' => '2'
        ),
        'RADIANS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'deg2rad',
            'argumentCount' => '1'
        ),
        'RAND' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::RAND',
            'argumentCount' => '0'
        ),
        'RANDBETWEEN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::RAND',
            'argumentCount' => '2'
        ),
        'RANK' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::RANK',
            'argumentCount' => '2,3'
        ),
        'RATE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::RATE',
            'argumentCount' => '3-6'
        ),
        'RECEIVED' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::RECEIVED',
            'argumentCount' => '4-5'
        ),
        'REPLACE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::REPLACE',
            'argumentCount' => '4'
        ),
        'REPLACEB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::REPLACE',
            'argumentCount' => '4'
        ),
        'REPT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'str_repeat',
            'argumentCount' => '2'
        ),
        'RIGHT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::RIGHT',
            'argumentCount' => '1,2'
        ),
        'RIGHTB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::RIGHT',
            'argumentCount' => '1,2'
        ),
        'ROMAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::ROMAN',
            'argumentCount' => '1,2'
        ),
        'ROUND' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'round',
            'argumentCount' => '2'
        ),
        'ROUNDDOWN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::ROUNDDOWN',
            'argumentCount' => '2'
        ),
        'ROUNDUP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::ROUNDUP',
            'argumentCount' => '2'
        ),
        'ROW' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::ROW',
            'argumentCount' => '-1',
            'passByReference' => array(true)
        ),
        'ROWS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::ROWS',
            'argumentCount' => '1'
        ),
        'RSQ' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::RSQ',
            'argumentCount' => '2'
        ),
        'RTD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '1+'
        ),
        'SEARCH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::SEARCHINSENSITIVE',
            'argumentCount' => '2,3'
        ),
        'SEARCHB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::SEARCHINSENSITIVE',
            'argumentCount' => '2,3'
        ),
        'SECOND' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::SECONDOFMINUTE',
            'argumentCount' => '1'
        ),
        'SERIESSUM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SERIESSUM',
            'argumentCount' => '4'
        ),
        'SIGN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SIGN',
            'argumentCount' => '1'
        ),
        'SIN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'sin',
            'argumentCount' => '1'
        ),
        'SINH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'sinh',
            'argumentCount' => '1'
        ),
        'SKEW' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::SKEW',
            'argumentCount' => '1+'
        ),
        'SLN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::SLN',
            'argumentCount' => '3'
        ),
        'SLOPE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::SLOPE',
            'argumentCount' => '2'
        ),
        'SMALL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::SMALL',
            'argumentCount' => '2'
        ),
        'SQRT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'sqrt',
            'argumentCount' => '1'
        ),
        'SQRTPI' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SQRTPI',
            'argumentCount' => '1'
        ),
        'STANDARDIZE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::STANDARDIZE',
            'argumentCount' => '3'
        ),
        'STDEV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::STDEV',
            'argumentCount' => '1+'
        ),
        'STDEVA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::STDEVA',
            'argumentCount' => '1+'
        ),
        'STDEVP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::STDEVP',
            'argumentCount' => '1+'
        ),
        'STDEVPA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::STDEVPA',
            'argumentCount' => '1+'
        ),
        'STEYX' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::STEYX',
            'argumentCount' => '2'
        ),
        'SUBSTITUTE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::SUBSTITUTE',
            'argumentCount' => '3,4'
        ),
        'SUBTOTAL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUBTOTAL',
            'argumentCount' => '2+'
        ),
        'SUM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUM',
            'argumentCount' => '1+'
        ),
        'SUMIF' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUMIF',
            'argumentCount' => '2,3'
        ),
        'SUMIFS' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUMIFS',
            'argumentCount' => '3+'
        ),
        'SUMPRODUCT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUMPRODUCT',
            'argumentCount' => '1+'
        ),
        'SUMSQ' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUMSQ',
            'argumentCount' => '1+'
        ),
        'SUMX2MY2' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUMX2MY2',
            'argumentCount' => '2'
        ),
        'SUMX2PY2' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUMX2PY2',
            'argumentCount' => '2'
        ),
        'SUMXMY2' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::SUMXMY2',
            'argumentCount' => '2'
        ),
        'SYD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::SYD',
            'argumentCount' => '4'
        ),
        'T' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::RETURNSTRING',
            'argumentCount' => '1'
        ),
        'TAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'tan',
            'argumentCount' => '1'
        ),
        'TANH' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'tanh',
            'argumentCount' => '1'
        ),
        'TBILLEQ' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::TBILLEQ',
            'argumentCount' => '3'
        ),
        'TBILLPRICE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::TBILLPRICE',
            'argumentCount' => '3'
        ),
        'TBILLYIELD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::TBILLYIELD',
            'argumentCount' => '3'
        ),
        'TDIST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::TDIST',
            'argumentCount' => '3'
        ),
        'TEXT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::TEXTFORMAT',
            'argumentCount' => '2'
        ),
        'TIME' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::TIME',
            'argumentCount' => '3'
        ),
        'TIMEVALUE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::TIMEVALUE',
            'argumentCount' => '1'
        ),
        'TINV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::TINV',
            'argumentCount' => '2'
        ),
        'TODAY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DATENOW',
            'argumentCount' => '0'
        ),
        'TRANSPOSE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::TRANSPOSE',
            'argumentCount' => '1'
        ),
        'TREND' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::TREND',
            'argumentCount' => '1-4'
        ),
        'TRIM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::TRIMSPACES',
            'argumentCount' => '1'
        ),
        'TRIMMEAN' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::TRIMMEAN',
            'argumentCount' => '2'
        ),
        'TRUE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOGICAL,
            'functionCall' => 'PHPExcel_Calculation_Logical::TRUE',
            'argumentCount' => '0'
        ),
        'TRUNC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_MATH_AND_TRIG,
            'functionCall' => 'PHPExcel_Calculation_MathTrig::TRUNC',
            'argumentCount' => '1,2'
        ),
        'TTEST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '4'
        ),
        'TYPE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::TYPE',
            'argumentCount' => '1'
        ),
        'UPPER' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::UPPERCASE',
            'argumentCount' => '1'
        ),
        'USDOLLAR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '2'
        ),
        'VALUE' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_TEXT_AND_DATA,
            'functionCall' => 'PHPExcel_Calculation_TextData::VALUE',
            'argumentCount' => '1'
        ),
        'VAR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::VARFunc',
            'argumentCount' => '1+'
        ),
        'VARA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::VARA',
            'argumentCount' => '1+'
        ),
        'VARP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::VARP',
            'argumentCount' => '1+'
        ),
        'VARPA' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::VARPA',
            'argumentCount' => '1+'
        ),
        'VDB' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '5-7'
        ),
        'VERSION' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_INFORMATION,
            'functionCall' => 'PHPExcel_Calculation_Functions::VERSION',
            'argumentCount' => '0'
        ),
        'VLOOKUP' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_LOOKUP_AND_REFERENCE,
            'functionCall' => 'PHPExcel_Calculation_LookupRef::VLOOKUP',
            'argumentCount' => '3,4'
        ),
        'WEEKDAY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::DAYOFWEEK',
            'argumentCount' => '1,2'
        ),
        'WEEKNUM' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::WEEKOFYEAR',
            'argumentCount' => '1,2'
        ),
        'WEIBULL' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::WEIBULL',
            'argumentCount' => '4'
        ),
        'WORKDAY' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::WORKDAY',
            'argumentCount' => '2+'
        ),
        'XIRR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::XIRR',
            'argumentCount' => '2,3'
        ),
        'XNPV' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::XNPV',
            'argumentCount' => '3'
        ),
        'YEAR' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::YEAR',
            'argumentCount' => '1'
        ),
        'YEARFRAC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_DATE_AND_TIME,
            'functionCall' => 'PHPExcel_Calculation_DateTime::YEARFRAC',
            'argumentCount' => '2,3'
        ),
        'YIELD' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Functions::DUMMY',
            'argumentCount' => '6,7'
        ),
        'YIELDDISC' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::YIELDDISC',
            'argumentCount' => '4,5'
        ),
        'YIELDMAT' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_FINANCIAL,
            'functionCall' => 'PHPExcel_Calculation_Financial::YIELDMAT',
            'argumentCount' => '5,6'
        ),
        'ZTEST' => array(
            'category' => PHPExcel_Calculation_Function::CATEGORY_STATISTICAL,
            'functionCall' => 'PHPExcel_Calculation_Statistical::ZTEST',
            'argumentCount' => '2-3'
        )
    );

    //    Internal functions used for special control purposes
    private static $controlFunctions = array(
        'MKMATRIX' => array(
            'argumentCount' => '*',
            'functionCall' => 'self::mkMatrix'
        )
    );


    public function __construct(PHPExcel $workbook = null)
    {
        $this->delta = 1 * pow(10, 0 - ini_get('precision'));

        $this->workbook = $workbook;
        $this->cyclicReferenceStack = new PHPExcel_CalcEngine_CyclicReferenceStack();
        $this->_debugLog = new PHPExcel_CalcEngine_Logger($this->cyclicReferenceStack);
    }


    private static function loadLocales()
    {
        $localeFileDirectory = PHPEXCEL_ROOT.'PHPExcel/locale/';
        foreach (glob($localeFileDirectory.'/*', GLOB_ONLYDIR) as $filename) {
            $filename = substr($filename, strlen($localeFileDirectory)+1);
            if ($filename != 'en') {
                self::$validLocaleLanguages[] = $filename;
            }
        }
    }

    /**
     * Get an instance of this class
     *
     * @access    public
     * @param   PHPExcel $workbook  Injected workbook for working with a PHPExcel object,
     *                                    or NULL to create a standalone claculation engine
     * @return PHPExcel_Calculation
     */
    public static function getInstance(PHPExcel $workbook = null)
    {
        if ($workbook !== null) {
            $instance = $workbook->getCalculationEngine();
            if (isset($instance)) {
                return $instance;  
            }
        }

        if (!isset(self::$instance) || (self::$instance === null)) {
            self::$instance = new PHPExcel_Calculation();
        }
        return self::$instance;
    }

    /**
     * Unset an instance of this class
     *
     * @access    public
     */
    public function __destruct()
    {
        $this->workbook = null;
    }

    /**
     * Flush the calculation cache for any existing instance of this class
     *        but only if a PHPExcel_Calculation instance exists
     *
     * @access    public
     * @return null
     */
    public function flushInstance()
    {
        $this->clearCalculationCache();
    }


    /**
     * Get the debuglog for this claculation engine instance
     *
     * @access    public
     * @return PHPExcel_CalcEngine_Logger
     */
    public function getDebugLog()
    {
        return $this->_debugLog;
    }

    /**
     * __clone implementation. Cloning should not be allowed in a Singleton!
     *
     * @access    public
     * @throws    PHPExcel_Calculation_Exception
     */
    final public function __clone()
    {
        throw new PHPExcel_Calculation_Exception('Cloning the calculation engine is not allowed!');
    }


    /**
     * Return the locale-specific translation of TRUE
     *
     * @access    public
     * @return     string        locale-specific translation of TRUE
     */
    public static function getTRUE()
    {
        return self::$localeBoolean['TRUE'];
    }

    /**
     * Return the locale-specific translation of FALSE
     *
     * @access    public
     * @return     string        locale-specific translation of FALSE
     */
    public static function getFALSE()
    {
        return self::$localeBoolean['FALSE'];
    }

    /**
     * Set the Array Return Type (Array or Value of first element in the array)
     *
     * @access    public
     * @param     string    $returnType            Array return type
     * @return     boolean                    Success or failure
     */
    public static function setArrayReturnType($returnType)
    {
        if (($returnType == self::RETURN_ARRAY_AS_VALUE) ||
            ($returnType == self::RETURN_ARRAY_AS_ERROR) ||
            ($returnType == self::RETURN_ARRAY_AS_ARRAY)) {
            self::$returnArrayAsType = $returnType;
            return true;
        }
        return false;
    }


    /**
     * Return the Array Return Type (Array or Value of first element in the array)
     *
     * @access    public
     * @return     string        $returnType            Array return type
     */
    public static function getArrayReturnType()
    {
        return self::$returnArrayAsType;
    }


    /**
     * Is calculation caching enabled?
     *
     * @access    public
     * @return boolean
     */
    public function getCalculationCacheEnabled()
    {
        return $this->calculationCacheEnabled;
    }

    /**
     * Enable/disable calculation cache
     *
     * @access    public
     * @param boolean $pValue
     */
    public function setCalculationCacheEnabled($pValue = true)
    {
        $this->calculationCacheEnabled = $pValue;
        $this->clearCalculationCache();
    }


    /**
     * Enable calculation cache
     */
    public function enableCalculationCache()
    {
        $this->setCalculationCacheEnabled(true);
    }


    /**
     * Disable calculation cache
     */
    public function disableCalculationCache()
    {
        $this->setCalculationCacheEnabled(false);
    }


    /**
     * Clear calculation cache
     */
    public function clearCalculationCache()
    {
        $this->calculationCache = array();
    }

    /**
     * Clear calculation cache for a specified worksheet
     *
     * @param string $worksheetName
     */
    public function clearCalculationCacheForWorksheet($worksheetName)
    {
        if (isset($this->calculationCache[$worksheetName])) {
            unset($this->calculationCache[$worksheetName]);
        }
    }

    /**
     * Rename calculation cache for a specified worksheet
     *
     * @param string $fromWorksheetName
     * @param string $toWorksheetName
     */
    public function renameCalculationCacheForWorksheet($fromWorksheetName, $toWorksheetName)
    {
        if (isset($this->calculationCache[$fromWorksheetName])) {
            $this->calculationCache[$toWorksheetName] = &$this->calculationCache[$fromWorksheetName];
            unset($this->calculationCache[$fromWorksheetName]);
        }
    }


    /**
     * Get the currently defined locale code
     *
     * @return string
     */
    public function getLocale()
    {
        return self::$localeLanguage;
    }


    /**
     * Set the locale code
     *
     * @param string $locale  The locale to use for formula translation
     * @return boolean
     */
    public function setLocale($locale = 'en_us')
    {
        //    Identify our locale and language
        $language = $locale = strtolower($locale);
        if (strpos($locale, '_') !== false) {
            list($language) = explode('_', $locale);
        }

        if (count(self::$validLocaleLanguages) == 1) {
            self::loadLocales();
        }
        //    Test whether we have any language data for this language (any locale)
        if (in_array($language, self::$validLocaleLanguages)) {
            //    initialise language/locale settings
            self::$localeFunctions = array();
            self::$localeArgumentSeparator = ',';
            self::$localeBoolean = array('TRUE' => 'TRUE', 'FALSE' => 'FALSE', 'NULL' => 'NULL');
            //    Default is English, if user isn't requesting english, then read the necessary data from the locale files
            if ($locale != 'en_us') {
                //    Search for a file with a list of function names for locale
                $functionNamesFile = PHPEXCEL_ROOT . 'PHPExcel'.DIRECTORY_SEPARATOR.'locale'.DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $locale).DIRECTORY_SEPARATOR.'functions';
                if (!file_exists($functionNamesFile)) {
                    //    If there isn't a locale specific function file, look for a language specific function file
                    $functionNamesFile = PHPEXCEL_ROOT . 'PHPExcel'.DIRECTORY_SEPARATOR.'locale'.DIRECTORY_SEPARATOR.$language.DIRECTORY_SEPARATOR.'functions';
                    if (!file_exists($functionNamesFile)) {
                        return false;
                    }
                }
                //    Retrieve the list of locale or language specific function names
                $localeFunctions = file($functionNamesFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($localeFunctions as $localeFunction) {
                    list($localeFunction) = explode('##', $localeFunction);    //    Strip out comments
                    if (strpos($localeFunction, '=') !== false) {
                        list($fName, $lfName) = explode('=', $localeFunction);
                        $fName = trim($fName);
                        $lfName = trim($lfName);
                        if ((isset(self::$PHPExcelFunctions[$fName])) && ($lfName != '') && ($fName != $lfName)) {
                            self::$localeFunctions[$fName] = $lfName;
                        }
                    }
                }
                //    Default the TRUE and FALSE constants to the locale names of the TRUE() and FALSE() functions
                if (isset(self::$localeFunctions['TRUE'])) {
                    self::$localeBoolean['TRUE'] = self::$localeFunctions['TRUE'];
                }
                if (isset(self::$localeFunctions['FALSE'])) {
                    self::$localeBoolean['FALSE'] = self::$localeFunctions['FALSE'];
                }

                $configFile = PHPEXCEL_ROOT . 'PHPExcel'.DIRECTORY_SEPARATOR.'locale'.DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $locale).DIRECTORY_SEPARATOR.'config';
                if (!file_exists($configFile)) {
                    $configFile = PHPEXCEL_ROOT . 'PHPExcel'.DIRECTORY_SEPARATOR.'locale'.DIRECTORY_SEPARATOR.$language.DIRECTORY_SEPARATOR.'config';
                }
                if (file_exists($configFile)) {
                    $localeSettings = file($configFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($localeSettings as $localeSetting) {
                        list($localeSetting) = explode('##', $localeSetting);    //    Strip out comments
                        if (strpos($localeSetting, '=') !== false) {
                            list($settingName, $settingValue) = explode('=', $localeSetting);
                            $settingName = strtoupper(trim($settingName));
                            switch ($settingName) {
                                case 'ARGUMENTSEPARATOR':
                                    self::$localeArgumentSeparator = trim($settingValue);
                                    break;
                            }
                        }
                    }
                }
            }

            self::$functionReplaceFromExcel = self::$functionReplaceToExcel =
            self::$functionReplaceFromLocale = self::$functionReplaceToLocale = null;
            self::$localeLanguage = $locale;
            return true;
        }
        return false;
    }



    public static function translateSeparator($fromSeparator, $toSeparator, $formula, &$inBraces)
    {
        $strlen = mb_strlen($formula);
        for ($i = 0; $i < $strlen; ++$i) {
            $chr = mb_substr($formula, $i, 1);
            switch ($chr) {
                case '{':
                    $inBraces = true;
                    break;
                case '}':
                    $inBraces = false;
                    break;
                case $fromSeparator:
                    if (!$inBraces) {
                        $formula = mb_substr($formula, 0, $i).$toSeparator.mb_substr($formula, $i+1);
                    }
            }
        }
        return $formula;
    }

    private static function translateFormula($from, $to, $formula, $fromSeparator, $toSeparator)
    {
        //    Convert any Excel function names to the required language
        if (self::$localeLanguage !== 'en_us') {
            $inBraces = false;
            //    If there is the possibility of braces within a quoted string, then we don't treat those as matrix indicators
            if (strpos($formula, '"') !== false) {
                //    So instead we skip replacing in any quoted strings by only replacing in every other array element after we've exploded
                //        the formula
                $temp = explode('"', $formula);
                $i = false;
                foreach ($temp as &$value) {
                    //    Only count/replace in alternating array entries
                    if ($i = !$i) {
                        $value = preg_replace($from, $to, $value);
                        $value = self::translateSeparator($fromSeparator, $toSeparator, $value, $inBraces);
                    }
                }
                unset($value);
                //    Then rebuild the formula string
                $formula = implode('"', $temp);
            } else {
                //    If there's no quoted strings, then we do a simple count/replace
                $formula = preg_replace($from, $to, $formula);
                $formula = self::translateSeparator($fromSeparator, $toSeparator, $formula, $inBraces);
            }
        }

        return $formula;
    }

    private static $functionReplaceFromExcel = null;
    private static $functionReplaceToLocale  = null;

    public function _translateFormulaToLocale($formula)
    {
        if (self::$functionReplaceFromExcel === null) {
            self::$functionReplaceFromExcel = array();
            foreach (array_keys(self::$localeFunctions) as $excelFunctionName) {
                self::$functionReplaceFromExcel[] = '/(@?[^\w\.])'.preg_quote($excelFunctionName).'([\s]*\()/Ui';
            }
            foreach (array_keys(self::$localeBoolean) as $excelBoolean) {
                self::$functionReplaceFromExcel[] = '/(@?[^\w\.])'.preg_quote($excelBoolean).'([^\w\.])/Ui';
            }

        }

        if (self::$functionReplaceToLocale === null) {
            self::$functionReplaceToLocale = array();
            foreach (array_values(self::$localeFunctions) as $localeFunctionName) {
                self::$functionReplaceToLocale[] = '$1'.trim($localeFunctionName).'$2';
            }
            foreach (array_values(self::$localeBoolean) as $localeBoolean) {
                self::$functionReplaceToLocale[] = '$1'.trim($localeBoolean).'$2';
            }
        }

        return self::translateFormula(self::$functionReplaceFromExcel, self::$functionReplaceToLocale, $formula, ',', self::$localeArgumentSeparator);
    }


    private static $functionReplaceFromLocale = null;
    private static $functionReplaceToExcel    = null;

    public function _translateFormulaToEnglish($formula)
    {
        if (self::$functionReplaceFromLocale === null) {
            self::$functionReplaceFromLocale = array();
            foreach (array_values(self::$localeFunctions) as $localeFunctionName) {
                self::$functionReplaceFromLocale[] = '/(@?[^\w\.])'.preg_quote($localeFunctionName).'([\s]*\()/Ui';
            }
            foreach (array_values(self::$localeBoolean) as $excelBoolean) {
                self::$functionReplaceFromLocale[] = '/(@?[^\w\.])'.preg_quote($excelBoolean).'([^\w\.])/Ui';
            }
        }

        if (self::$functionReplaceToExcel === null) {
            self::$functionReplaceToExcel = array();
            foreach (array_keys(self::$localeFunctions) as $excelFunctionName) {
                self::$functionReplaceToExcel[] = '$1'.trim($excelFunctionName).'$2';
            }
            foreach (array_keys(self::$localeBoolean) as $excelBoolean) {
                self::$functionReplaceToExcel[] = '$1'.trim($excelBoolean).'$2';
            }
        }

        return self::translateFormula(self::$functionReplaceFromLocale, self::$functionReplaceToExcel, $formula, self::$localeArgumentSeparator, ',');
    }


    public static function localeFunc($function)
    {
        if (self::$localeLanguage !== 'en_us') {
            $functionName = trim($function, '(');
            if (isset(self::$localeFunctions[$functionName])) {
                $brace = ($functionName != $function);
                $function = self::$localeFunctions[$functionName];
                if ($brace) {
                    $function .= '(';
                }
            }
        }
        return $function;
    }




    /**
     * Wrap string values in quotes
     *
     * @param mixed $value
     * @return mixed
     */
    public static function wrapResult($value)
    {
        if (is_string($value)) {
            //    Error values cannot be "wrapped"
            if (preg_match('/^'.self::CALCULATION_REGEXP_ERROR.'$/i', $value, $match)) {
                //    Return Excel errors "as is"
                return $value;
            }
            //    Return strings wrapped in quotes
            return '"'.$value.'"';
        //    Convert numeric errors to NaN error
        } elseif ((is_float($value)) && ((is_nan($value)) || (is_infinite($value)))) {
            return PHPExcel_Calculation_Functions::NaN();
        }

        return $value;
    }


    /**
     * Remove quotes used as a wrapper to identify string values
     *
     * @param mixed $value
     * @return mixed
     */
   




    /**
     * Calculate cell value (using formula from a cell ID)
     * Retained for backward compatibility
     *
     * @access    public
     * @param    PHPExcel_Cell    $pCell    Cell to calculate
     * @return    mixed
     * @throws    PHPExcel_Calculation_Exception
     */
    public function calculate(PHPExcel_Cell $pCell = null)
    {
        try {
            return $this->calculateCellValue($pCell);
        } catch (PHPExcel_Exception $e) {
            throw new PHPExcel_Calculation_Exception($e->getMessage());
        }
    }


    /**
     * Calculate the value of a cell formula
     *
     * @access    public
     * @param    PHPExcel_Cell    $pCell        Cell to calculate
     * @param    Boolean            $resetLog    Flag indicating whether the debug log should be reset or not
     * @return    mixed
     * @throws    PHPExcel_Calculation_Exception
     */
    public function calculateCellValue(PHPExcel_Cell $pCell = null, $resetLog = true)
    {
        if ($pCell === null) {
            return null;
        }

        $returnArrayAsType = self::$returnArrayAsType;
        if ($resetLog) {
            //    Initialise the logging settings if requested
            $this->formulaError = null;
            $this->_debugLog->clearLog();
            $this->cyclicReferenceStack->clear();
            $this->cyclicFormulaCounter = 1;

            self::$returnArrayAsType = self::RETURN_ARRAY_AS_ARRAY;
        }

        //    Execute the calculation for the cell formula
        $this->cellStack[] = array(
            'sheet' => $pCell->getWorksheet()->getTitle(),
            'cell' => $pCell->getCoordinate(),
        );
        try {
            $result = self::unwrapResult($this->_calculateFormulaValue($pCell->getValue(), $pCell->getCoordinate(), $pCell));
            $cellAddress = array_pop($this->cellStack);
            $this->workbook->getSheetByName($cellAddress['sheet'])->getCell($cellAddress['cell']);
        } catch (PHPExcel_Exception $e) {
            $cellAddress = array_pop($this->cellStack);
            $this->workbook->getSheetByName($cellAddress['sheet'])->getCell($cellAddress['cell']);
            throw new PHPExcel_Calculation_Exception($e->getMessage());
        }

        if ((is_array($result)) && (self::$returnArrayAsType != self::RETURN_ARRAY_AS_ARRAY)) {
            self::$returnArrayAsType = $returnArrayAsType;
            $testResult = PHPExcel_Calculation_Functions::flattenArray($result);
            if (self::$returnArrayAsType == self::RETURN_ARRAY_AS_ERROR) {
                return PHPExcel_Calculation_Functions::VALUE();
            }
            //    If there's only a single cell in the array, then we allow it
            if (count($testResult) != 1) {
                //    If keys are numeric, then it's a matrix result rather than a cell range result, so we permit it
                $r = array_keys($result);
                $r = array_shift($r);
                if (!is_numeric($r)) {
                    return PHPExcel_Calculation_Functions::VALUE();
                }
                if (is_array($result[$r])) {
                    $c = array_keys($result[$r]);
                    $c = array_shift($c);
                    if (!is_numeric($c)) {
                        return PHPExcel_Calculation_Functions::VALUE();
                    }
                }
            }
            $result = array_shift($testResult);
        }
        self::$returnArrayAsType = $returnArrayAsType;


        if ($result === null) {
            return 0;
        } elseif ((is_float($result)) && ((is_nan($result)) || (is_infinite($result)))) {
            return PHPExcel_Calculation_Functions::NaN();
        }
        return $result;
    }


    /**
     * Validate and parse a formula string
     *
     * @param    string        $formula        Formula to parse
     * @return    array
     * @throws    PHPExcel_Calculation_Exception
     */
   


    /**
     * Calculate the value of a formula
     *
     * @param    string            $formula    Formula to parse
     * @param    string            $cellID        Address of the cell to calculate
     * @param    PHPExcel_Cell    $pCell        Cell to calculate
     * @return    mixed
     * @throws    PHPExcel_Calculation_Exception
     */
    public function calculateFormula($formula, $cellID = null, PHPExcel_Cell $pCell = null)
    {
        //    Initialise the logging settings
        $this->formulaError = null;
        $this->_debugLog->clearLog();
        $this->cyclicReferenceStack->clear();

        if ($this->workbook !== null && $cellID === null && $pCell === null) {
            $cellID = 'A1';
            $pCell = $this->workbook->getActiveSheet()->getCell($cellID);
        } else {
            //    Disable calculation cacheing because it only applies to cell calculations, not straight formulae
            //    But don't actually flush any cache
            $resetCache = $this->getCalculationCacheEnabled();
            $this->calculationCacheEnabled = false;
        }

        //    Execute the calculation
        try {
            $result = self::unwrapResult($this->_calculateFormulaValue($formula, $cellID, $pCell));
        } catch (PHPExcel_Exception $e) {
            throw new PHPExcel_Calculation_Exception($e->getMessage());
        }

        if ($this->workbook === null) {
            //    Reset calculation cacheing to its previous state
            $this->calculationCacheEnabled = $resetCache;
        }

        return $result;
    }


    public function getValueFromCache($cellReference, &$cellValue)
    {
        // Is calculation cacheing enabled?
        // Is the value present in calculation cache?
        $this->_debugLog->writeDebugLog('Testing cache value for cell ', $cellReference);
        if (($this->calculationCacheEnabled) && (isset($this->calculationCache[$cellReference]))) {
            $this->_debugLog->writeDebugLog('Retrieving value for cell ', $cellReference, ' from cache');
            // Return the cached result
            $cellValue = $this->calculationCache[$cellReference];
            return true;
        }
        return false;
    }

    public function saveValueToCache($cellReference, $cellValue)
    {
        if ($this->calculationCacheEnabled) {
            $this->calculationCache[$cellReference] = $cellValue;
        }
    }

    /**
     * Parse a cell formula and calculate its value
     *
     * @param    string            $formula    The formula to parse and calculate
     * @param    string            $cellID        The ID (e.g. A3) of the cell that we are calculating
     * @param    PHPExcel_Cell    $pCell        Cell to calculate
     * @return    mixed
     * @throws    PHPExcel_Calculation_Exception
     */
    public function _calculateFormulaValue($formula, $cellID = null, PHPExcel_Cell $pCell = null)
    {
        $cellValue = null;

        //    Basic validation that this is indeed a formula
        //    We simply return the cell value if not
        $formula = trim($formula);

        $formula = ltrim(substr($formula, 1));
        if (!isset($formula{0})) {
            return self::wrapResult($formula);
        }

        $pCellParent = ($pCell !== null) ? $pCell->getWorksheet() : null;
        $wsTitle = ($pCellParent !== null) ? $pCellParent->getTitle() : "\x00Wrk";
        $wsCellReference = $wsTitle . '!' . $cellID;

        if (($cellID !== null) && ($this->getValueFromCache($wsCellReference, $cellValue))) {
            return $cellValue;
        }



        //    Parse the formula onto the token stack and calculate the value
        $this->cyclicReferenceStack->push($wsCellReference);
        $cellValue = $this->processTokenStack($this->_parseFormula($formula, $pCell), $cellID, $pCell);
        $this->cyclicReferenceStack->pop();

        // Save to calculation cache
        if ($cellID !== null) {
            $this->saveValueToCache($wsCellReference, $cellValue);
        }

        //    Return the calculated value
        return $cellValue;
    }


    /**
     * Ensure that paired matrix operands are both matrices and of the same size
     *
     * @param    mixed        &$operand1    First matrix operand
     * @param    mixed        &$operand2    Second matrix operand
     * @param    integer        $resize        Flag indicating whether the matrices should be resized to match
     *                                        and (if so), whether the smaller dimension should grow or the
     *                                        larger should shrink.
     *                                            0 = no resize
     *                                            1 = shrink to fit
     *                                            2 = extend to fit
     */
    private static function checkMatrixOperands(&$operand1, &$operand2, $resize = 1)
    {
        //    Examine each of the two operands, and turn them into an array if they aren't one already
        //    Note that this function should only be called if one or both of the operand is already an array
        if (!is_array($operand1)) {
            list($matrixRows, $matrixColumns) = self::getMatrixDimensions($operand2);
            $operand1 = array_fill(0, $matrixRows, array_fill(0, $matrixColumns, $operand1));
            $resize = 0;
        } elseif (!is_array($operand2)) {
            list($matrixRows, $matrixColumns) = self::getMatrixDimensions($operand1);
            $operand2 = array_fill(0, $matrixRows, array_fill(0, $matrixColumns, $operand2));
            $resize = 0;
        }

        list($matrix1Rows, $matrix1Columns) = self::getMatrixDimensions($operand1);
        list($matrix2Rows, $matrix2Columns) = self::getMatrixDimensions($operand2);
        if (($matrix1Rows == $matrix2Columns) && ($matrix2Rows == $matrix1Columns)) {
            $resize = 1;
        }

        if ($resize == 2) {
            //    Given two matrices of (potentially) unequal size, convert the smaller in each dimension to match the larger
            self::resizeMatricesExtend($operand1, $operand2, $matrix1Rows, $matrix1Columns, $matrix2Rows, $matrix2Columns);
        } elseif ($resize == 1) {
            //    Given two matrices of (potentially) unequal size, convert the larger in each dimension to match the smaller
            self::resizeMatricesShrink($operand1, $operand2, $matrix1Rows, $matrix1Columns, $matrix2Rows, $matrix2Columns);
        }
        return array( $matrix1Rows, $matrix1Columns, $matrix2Rows, $matrix2Columns);
    }


    /**
     * Read the dimensions of a matrix, and re-index it with straight numeric keys starting from row 0, column 0
     *
     * @param    mixed        &$matrix        matrix operand
     * @return    array        An array comprising the number of rows, and number of columns
     */
    private static function getMatrixDimensions(&$matrix)
    {
        $matrixRows = count($matrix);
        $matrixColumns = 0;
        foreach ($matrix as $rowKey => $rowValue) {
            $matrixColumns = max(count($rowValue), $matrixColumns);
            if (!is_array($rowValue)) {
                $matrix[$rowKey] = array($rowValue);
            } else {
                $matrix[$rowKey] = array_values($rowValue);
            }
        }
        $matrix = array_values($matrix);
        return array($matrixRows, $matrixColumns);
    }


    /**
     * Ensure that paired matrix operands are both matrices of the same size
     *
     * @param    mixed        &$matrix1        First matrix operand
     * @param    mixed        &$matrix2        Second matrix operand
     * @param    integer        $matrix1Rows    Row size of first matrix operand
     * @param    integer        $matrix1Columns    Column size of first matrix operand
     * @param    integer        $matrix2Rows    Row size of second matrix operand
     * @param    integer        $matrix2Columns    Column size of second matrix operand
     */
    private static function resizeMatricesShrink(&$matrix1, &$matrix2, $matrix1Rows, $matrix1Columns, $matrix2Rows, $matrix2Columns)
    {
        if (($matrix2Columns < $matrix1Columns) || ($matrix2Rows < $matrix1Rows)) {
            if ($matrix2Rows < $matrix1Rows) {
                for ($i = $matrix2Rows; $i < $matrix1Rows; ++$i) {
                    unset($matrix1[$i]);
                }
            }
            if ($matrix2Columns < $matrix1Columns) {
                for ($i = 0; $i < $matrix1Rows; ++$i) {
                    for ($j = $matrix2Columns; $j < $matrix1Columns; ++$j) {
                        unset($matrix1[$i][$j]);
                    }
                }
            }
        }

        if (($matrix1Columns < $matrix2Columns) || ($matrix1Rows < $matrix2Rows)) {
            if ($matrix1Rows < $matrix2Rows) {
                for ($i = $matrix1Rows; $i < $matrix2Rows; ++$i) {
                    unset($matrix2[$i]);
                }
            }
            if ($matrix1Columns < $matrix2Columns) {
                for ($i = 0; $i < $matrix2Rows; ++$i) {
                    for ($j = $matrix1Columns; $j < $matrix2Columns; ++$j) {
                        unset($matrix2[$i][$j]);
                    }
                }
            }
        }
    }


    /**
     * Ensure that paired matrix operands are both matrices of the same size
     *
     * @param    mixed        &$matrix1    First matrix operand
     * @param    mixed        &$matrix2    Second matrix operand
     * @param    integer        $matrix1Rows    Row size of first matrix operand
     * @param    integer        $matrix1Columns    Column size of first matrix operand
     * @param    integer        $matrix2Rows    Row size of second matrix operand
     * @param    integer        $matrix2Columns    Column size of second matrix operand
     */
    private static function resizeMatricesExtend(&$matrix1, &$matrix2, $matrix1Rows, $matrix1Columns, $matrix2Rows, $matrix2Columns)
    {
        if (($matrix2Columns < $matrix1Columns) || ($matrix2Rows < $matrix1Rows)) {
            if ($matrix2Columns < $matrix1Columns) {
                for ($i = 0; $i < $matrix2Rows; ++$i) {
                    $x = $matrix2[$i][$matrix2Columns-1];
                    for ($j = $matrix2Columns; $j < $matrix1Columns; ++$j) {
                        $matrix2[$i][$j] = $x;
                    }
                }
            }
            if ($matrix2Rows < $matrix1Rows) {
                $x = $matrix2[$matrix2Rows-1];
                for ($i = 0; $i < $matrix1Rows; ++$i) {
                    $matrix2[$i] = $x;
                }
            }
        }

        if (($matrix1Columns < $matrix2Columns) || ($matrix1Rows < $matrix2Rows)) {
            if ($matrix1Columns < $matrix2Columns) {
                for ($i = 0; $i < $matrix1Rows; ++$i) {
                    $x = $matrix1[$i][$matrix1Columns-1];
                    for ($j = $matrix1Columns; $j < $matrix2Columns; ++$j) {
                        $matrix1[$i][$j] = $x;
                    }
                }
            }
            if ($matrix1Rows < $matrix2Rows) {
                $x = $matrix1[$matrix1Rows-1];
                for ($i = 0; $i < $matrix2Rows; ++$i) {
                    $matrix1[$i] = $x;
                }
            }
        }
    }


    /**
     * Format details of an operand for display in the log (based on operand type)
     *
     * @param    mixed        $value    First matrix operand
     * @return    mixed
     */
    private function showValue($value)
    {
        if ($this->_debugLog->getWriteDebugLog()) {
            $testArray = PHPExcel_Calculation_Functions::flattenArray($value);
            if (count($testArray) == 1) {
                $value = array_pop($testArray);
            }

            if (is_array($value)) {
                $returnMatrix = array();
                $pad = $rpad = ', ';
                foreach ($value as $row) {
                    if (is_array($row)) {
                        $returnMatrix[] = implode($pad, array_map(array($this, 'showValue'), $row));
                        $rpad = '; ';
                    } else {
                        $returnMatrix[] = $this->showValue($row);
                    }
                }
                return '{ '.implode($rpad, $returnMatrix).' }';
            } elseif (is_string($value) && (trim($value, '"') == $value)) {
                return '"'.$value.'"';
            } elseif (is_bool($value)) {
                return ($value) ? self::$localeBoolean['TRUE'] : self::$localeBoolean['FALSE'];
            }
        }
        return PHPExcel_Calculation_Functions::flattenSingleValue($value);
    }


    /**
     * Format type and details of an operand for display in the log (based on operand type)
     *
     * @param    mixed        $value    First matrix operand
     * @return    mixed
     */
    private function showTypeDetails($value)
    {
        if ($this->_debugLog->getWriteDebugLog()) {
            $testArray = PHPExcel_Calculation_Functions::flattenArray($value);
            if (count($testArray) == 1) {
                $value = array_pop($testArray);
            }

            if ($value === null) {
                return 'a NULL value';
            } elseif (is_float($value)) {
                $typeString = 'a floating point number';
            } elseif (is_int($value)) {
                $typeString = 'an integer number';
            } elseif (is_bool($value)) {
                $typeString = 'a boolean';
            } elseif (is_array($value)) {
                $typeString = 'a matrix';
            } else {
                if ($value == '') {
                    return 'an empty string';
                }  else {
                    $typeString = 'a string';
                }
            }
            return $typeString.' with a value of '.$this->showValue($value);
        }
    }


    private function convertMatrixReferences($formula)
    {
        static $matrixReplaceFrom = array('{', ';', '}');
        static $matrixReplaceTo = array('MKMATRIX(MKMATRIX(', '),MKMATRIX(', '))');

        //    Convert any Excel matrix references to the MKMATRIX() function
        if (strpos($formula, '{') !== false) {
            //    If there is the possibility of braces within a quoted string, then we don't treat those as matrix indicators
            if (strpos($formula, '"') !== false) {
                //    So instead we skip replacing in any quoted strings by only replacing in every other array element after we've exploded
                //        the formula
                $temp = explode('"', $formula);
                //    Open and Closed counts used for trapping mismatched braces in the formula
                $openCount = $closeCount = 0;
                $i = false;
                foreach ($temp as &$value) {
                    //    Only count/replace in alternating array entries
                    if ($i = !$i) {
                        $openCount += substr_count($value, '{');
                        $closeCount += substr_count($value, '}');
                        $value = str_replace($matrixReplaceFrom, $matrixReplaceTo, $value);
                    }
                }
                unset($value);
                //    Then rebuild the formula string
                $formula = implode('"', $temp);
            } else {
                //    If there's no quoted strings, then we do a simple count/replace
                $openCount = substr_count($formula, '{');
                $closeCount = substr_count($formula, '}');
                $formula = str_replace($matrixReplaceFrom, $matrixReplaceTo, $formula);
            }
            //    Trap for mismatched braces and trigger an appropriate error
            if ($openCount < $closeCount) {
                if ($openCount > 0) {
                    return $this->raiseFormulaError("Formula Error: Mismatched matrix braces '}'");
                } else {
                    return $this->raiseFormulaError("Formula Error: Unexpected '}' encountered");
                }
            } elseif ($openCount > $closeCount) {
                if ($closeCount > 0) {
                    return $this->raiseFormulaError("Formula Error: Mismatched matrix braces '{'");
                } else {
                    return $this->raiseFormulaError("Formula Error: Unexpected '{' encountered");
                }
            }
        }

        return $formula;
    }


    private static function mkMatrix()
    {
        return func_get_args();
    }


    //    Binary Operators
    //    These operators always work on two values
    //    Array key is the operator, the value indicates whether this is a left or right associative operator
    private static $operatorAssociativity    = array(
        '^' => 0,                                                            //    Exponentiation
        '*' => 0, '/' => 0,                                                 //    Multiplication and Division
        '+' => 0, '-' => 0,                                                    //    Addition and Subtraction
        '&' => 0,                                                            //    Concatenation
        '|' => 0, ':' => 0,                                                    //    Intersect and Range
        '>' => 0, '<' => 0, '=' => 0, '>=' => 0, '<=' => 0, '<>' => 0        //    Comparison
    );

    //    Comparison (Boolean) Operators
    //    These operators work on two values, but always return a boolean result
    private static $comparisonOperators    = array('>' => true, '<' => true, '=' => true, '>=' => true, '<=' => true, '<>' => true);

    //    Operator Precedence
    //    This list includes all valid operators, whether binary (including boolean) or unary (such as %)
    //    Array key is the operator, the value is its precedence
    private static $operatorPrecedence    = array(
        ':' => 8,                                                                //    Range
        '|' => 7,                                                                //    Intersect
        '~' => 6,                                                                //    Negation
        '%' => 5,                                                                //    Percentage
        '^' => 4,                                                                //    Exponentiation
        '*' => 3, '/' => 3,                                                     //    Multiplication and Division
        '+' => 2, '-' => 2,                                                        //    Addition and Subtraction
        '&' => 1,                                                                //    Concatenation
        '>' => 0, '<' => 0, '=' => 0, '>=' => 0, '<=' => 0, '<>' => 0            //    Comparison
    );

    // Convert infix to postfix notatio

    private static function dataTestReference(&$operandData)
    {
        $operand = $operandData['value'];
        if (($operandData['reference'] === null) && (is_array($operand))) {
            $rKeys = array_keys($operand);
            $rowKey = array_shift($rKeys);
            $cKeys = array_keys(array_keys($operand[$rowKey]));
            $colKey = array_shift($cKeys);
            if (ctype_upper($colKey)) {
                $operandData['reference'] = $colKey.$rowKey;
            }
        }
        return $operand;
    }

    // evaluate postfix notation
   


    /**
     * Compare two strings in the same way as strcmp() except that lowercase come before uppercase letters
     * @param    string    $str1    First string value for the comparison
     * @param    string    $str2    Second string value for the comparison
     * @return   integer
     */
  

    // trigger an error, but nicely, if need be
    protected function raiseFormulaError($errorMessage)
    {
        $this->formulaError = $errorMessage;
        $this->cyclicReferenceStack->clear();
        if (!$this->suppressFormulaErrors) {
            throw new PHPExcel_Calculation_Exception($errorMessage);
        }
        trigger_error($errorMessage, E_USER_ERROR);
    }


    /**
     * Extract range values
     *
     * @param    string                &$pRange    String based range representation
     * @param    PHPExcel_Worksheet    $pSheet        Worksheet
     * @param    boolean                $resetLog    Flag indicating whether calculation log should be reset or not
     * @return  mixed                Array of values in range if range contains more than one element. Otherwise, a single value is returned.
     * @throws    PHPExcel_Calculation_Exception
     */
    public function extractCellRange(&$pRange = 'A1', PHPExcel_Worksheet $pSheet = null, $resetLog = true)
    {
        // Return value
        $returnValue = array ();

//        echo 'extractCellRange('.$pRange.')', PHP_EOL;
        if ($pSheet !== null) {
            $pSheetName = $pSheet->getTitle();
//            echo 'Passed sheet name is '.$pSheetName.PHP_EOL;
//            echo 'Range reference is '.$pRange.PHP_EOL;
            if (strpos($pRange, '!') !== false) {
//                echo '$pRange reference includes sheet reference', PHP_EOL;
                list($pSheetName, $pRange) = PHPExcel_Worksheet::extractSheetTitle($pRange, true);
//                echo 'New sheet name is '.$pSheetName, PHP_EOL;
//                echo 'Adjusted Range reference is '.$pRange, PHP_EOL;
                $pSheet = $this->workbook->getSheetByName($pSheetName);
            }

            // Extract range
            $aReferences = PHPExcel_Cell::extractAllCellReferencesInRange($pRange);
            $pRange = $pSheetName.'!'.$pRange;
            if (!isset($aReferences[1])) {
                //    Single cell in range
                sscanf($aReferences[0], '%[A-Z]%d', $currentCol, $currentRow);
                $cellValue = null;
                if ($pSheet->cellExists($aReferences[0])) {
                    $returnValue[$currentRow][$currentCol] = $pSheet->getCell($aReferences[0])->getCalculatedValue($resetLog);
                } else {
                    $returnValue[$currentRow][$currentCol] = null;
                }
            } else {
                // Extract cell data for all cells in the range
                foreach ($aReferences as $reference) {
                    // Extract range
                    sscanf($reference, '%[A-Z]%d', $currentCol, $currentRow);
                    $cellValue = null;
                    if ($pSheet->cellExists($reference)) {
                        $returnValue[$currentRow][$currentCol] = $pSheet->getCell($reference)->getCalculatedValue($resetLog);
                    } else {
                        $returnValue[$currentRow][$currentCol] = null;
                    }
                }
            }
        }

        return $returnValue;
    }


    /**
     * Extract range values
     *
     * @param    string                &$pRange    String based range representation
     * @param    PHPExcel_Worksheet    $pSheet        Worksheet
     * @return  mixed                Array of values in range if range contains more than one element. Otherwise, a single value is returned.
     * @param    boolean                $resetLog    Flag indicating whether calculation log should be reset or not
     * @throws    PHPExcel_Calculation_Exception
     */
    public function extractNamedRange(&$pRange = 'A1', PHPExcel_Worksheet $pSheet = null, $resetLog = true)
    {
        // Return value
        $returnValue = array ();

//        echo 'extractNamedRange('.$pRange.')<br />';
        if ($pSheet !== null) {
            $pSheetName = $pSheet->getTitle();
//            echo 'Current sheet name is '.$pSheetName.'<br />';
//            echo 'Range reference is '.$pRange.'<br />';
            if (strpos($pRange, '!') !== false) {
//                echo '$pRange reference includes sheet reference', PHP_EOL;
                list($pSheetName, $pRange) = PHPExcel_Worksheet::extractSheetTitle($pRange, true);
//                echo 'New sheet name is '.$pSheetName, PHP_EOL;
//                echo 'Adjusted Range reference is '.$pRange, PHP_EOL;
                $pSheet = $this->workbook->getSheetByName($pSheetName);
            }

            // Named range?
            $namedRange = PHPExcel_NamedRange::resolveRange($pRange, $pSheet);
            if ($namedRange !== null) {
                $pSheet = $namedRange->getWorksheet();
//                echo 'Named Range '.$pRange.' (';
                $pRange = $namedRange->getRange();
                $splitRange = PHPExcel_Cell::splitRange($pRange);
                //    Convert row and column references
                if (ctype_alpha($splitRange[0][0])) {
                    $pRange = $splitRange[0][0] . '1:' . $splitRange[0][1] . $namedRange->getWorksheet()->getHighestRow();
                } elseif (ctype_digit($splitRange[0][0])) {
                    $pRange = 'A' . $splitRange[0][0] . ':' . $namedRange->getWorksheet()->getHighestColumn() . $splitRange[0][1];
                }
//                echo $pRange.') is in sheet '.$namedRange->getWorksheet()->getTitle().'<br />';

//                if ($pSheet->getTitle() != $namedRange->getWorksheet()->getTitle()) {
//                    if (!$namedRange->getLocalOnly()) {
//                        $pSheet = $namedRange->getWorksheet();
//                    } else {
//                        return $returnValue;
//                    }
//                }
            } else {
                return PHPExcel_Calculation_Functions::REF();
            }

            // Extract range
            $aReferences = PHPExcel_Cell::extractAllCellReferencesInRange($pRange);
//            var_dump($aReferences);
            if (!isset($aReferences[1])) {
                //    Single cell (or single column or row) in range
                list($currentCol, $currentRow) = PHPExcel_Cell::coordinateFromString($aReferences[0]);
                $cellValue = null;
                if ($pSheet->cellExists($aReferences[0])) {
                    $returnValue[$currentRow][$currentCol] = $pSheet->getCell($aReferences[0])->getCalculatedValue($resetLog);
                } else {
                    $returnValue[$currentRow][$currentCol] = null;
                }
            } else {
                // Extract cell data for all cells in the range
                foreach ($aReferences as $reference) {
                    // Extract range
                    list($currentCol, $currentRow) = PHPExcel_Cell::coordinateFromString($reference);
//                    echo 'NAMED RANGE: $currentCol='.$currentCol.' $currentRow='.$currentRow.'<br />';
                    $cellValue = null;
                    if ($pSheet->cellExists($reference)) {
                        $returnValue[$currentRow][$currentCol] = $pSheet->getCell($reference)->getCalculatedValue($resetLog);
                    } else {
                        $returnValue[$currentRow][$currentCol] = null;
                    }
                }
            }
//                print_r($returnValue);
//            echo '<br />';
        }

        return $returnValue;
    }


    /**
     * Is a specific function implemented?
     *
     * @param    string    $pFunction    Function Name
     * @return    boolean
     */
    public function isImplemented($pFunction = '')
    {
        $pFunction = strtoupper($pFunction);
        if (isset(self::$PHPExcelFunctions[$pFunction])) {
            return (self::$PHPExcelFunctions[$pFunction]['functionCall'] != 'PHPExcel_Calculation_Functions::DUMMY');
        } else {
            return false;
        }
    }


    /**
     * Get a list of all implemented functions as an array of function objects
     *
     * @return    array of PHPExcel_Calculation_Function
     */
    public function listFunctions()
    {
        $returnValue = array();

        foreach (self::$PHPExcelFunctions as $functionName => $function) {
            if ($function['functionCall'] != 'PHPExcel_Calculation_Functions::DUMMY') {
                $returnValue[$functionName] = new PHPExcel_Calculation_Function(
                    $function['category'],
                    $functionName,
                    $function['functionCall']
                );
            }
        }

        return $returnValue;
    }


    /**
     * Get a list of all Excel function names
     *
     * @return    array
     */
    public function listAllFunctionNames()
    {
        return array_keys(self::$PHPExcelFunctions);
    }

    /**
     * Get a list of implemented Excel function names
     *
     * @return    array
     */
    public function listFunctionNames()
    {
        $returnValue = array();
        foreach (self::$PHPExcelFunctions as $functionName => $function) {
            if ($function['functionCall'] != 'PHPExcel_Calculation_Functions::DUMMY') {
                $returnValue[] = $functionName;
            }
        }

        return $returnValue;
    }
}
