<?php 
/**************************************FUNIO CREAR OPCIO AL MENU (taxis_entrades)****************************************/

//Eliminar-les de la base de dades
/*delete FROM `wp54nhgt_posts` WHERE `post_title` LIKE '%Taxi en%' and `post_date` LIKE '%2018-04-09%'*/

function crear_opcio_menu(){
    add_menu_page( 
        __( '+ Entrades', 'textdomain' ),
        'Crear Entrades',
        'manage_options',
        'custompage',
        'crear_entrades_automatiques',
        plugins_url( 'myplugin/images/icon.png' ),
        6
    ); 
}
add_action( 'admin_menu', 'crear_opcio_menu' );

//FUNCIO QUE SEXECUTARA AL APRETAR LOPCIO
function crear_entrades_automatiques(){
    
    //Poblacions:
    
    $poblacions = "ARAGON | AEROPUERTOS | BARCELONA | IGUALADA | TARREGA | BARBASTRO | MONZÓN | TORREDEMBARRA |MANRESA | TERRASA | MOLLERUSSA | HUESCA | ZARAGOZA | HOSPITALES |PIRINEO ARAGONES | PIRINEO CATALAN | ENTIDADES BANCARIAS ANDORRANAS | CALAHORRA | LOGROÑO | COSTABRAVA | COSTADAURADA | PLATGES MEDITERRANI | AGRAMUNT | ANDORRA | BAQUEIRA | LLEIDA | TARRAGONA | GIRONA | HUESCA | CASTELLÓN | VALENCIA | ALICANTE | MURCIA | ALMERÍA | GRANADA | MÁLAGA | CÁDIZ | SEVILLA | HUELVA | CÓRDOBA | JAEN | CÁCERES | BADAJOZ | CIUDAD REAL | ALBACETE | CUENCA | TOLEDO | GUADALAJARA | MADRID | ÁVILA | SEGOVIA | SORIA | SALAMANCA | VALLADOLID | ZAMORA | LEÓN | PALENCIA | BURGOS | LA RIOJA | NAVARRA | ÁLAVA | VIZKAYA | GUIPÚZCOA | LEÓN | CANTABRIA | ASTURIAS | LUGO | ORENSE | PONTEVEDRA | LA CORUÑA | PARIS | LOURDES | PERPIÑA | TOULOUSE | BURDEOS | CALAF | GUISSONA | PONTS | ORGANYA | TREMP | POBLA DE SEGUR | PUENTE DE MONTAÑANA | BENABARRE | GRAUS | SOPEIRA | BENASQUE | ESTERRI D’ANEU | RIALP | SORT | PUIGERDA | PAS DE LA CASA | MEQUINENZA | BUJARALOZ | ALCAÑIZ | CASPE | FLIX | TORTOSA | AMPOSTA | VALLS | SALARDU | ARTIES | GAROS | ESCUNHAU | TREDOS | UNHA | GESSA | BETREN | LA MASSANA | ENCAMP | ORDINO | CANILLO | SOLDEU | LLADURS | BELLPUIG | BELL.LLOC | LINYOLA | BELLCAIRE | ALMENAR | ALFARRAS | ALTORRICON | ALMACELLES | TAMARITE | RAIMAT | PLA DE LA FONT | GIMENELLS | AITONA | SEROS | TORRENTE DE CINCA | MEQUINENZA | MAILAS | TORREBESSES | ASPA | ALFES | GRANYENA | ALCANO | CASTELLDANS | TORREGROSSA | IVARS | EL POAL | LES AVELLANES | CAMARASA | VENDRELL | CALAFELL | LA PINEDA | VILANFRANCA DEL PENEDES | TORREDENBARRA | COMARRUGA | VILANOVA I LA GELTRU | SITGES | HOSPITALET | BADALONA | MATARO | SABADELL | TERRASSA | MARTORELL | MATARO | PUIGCERDA | GRANOLLERS | CALELLA | CASTELLDEFELS | CERDANYOLA | SAN CUGAT | MONTSERRAT | MOLINS DE REI | RUBI | ESPLUGUES | MIAMI | TORTOSSA | DELTA DEL EBRE | VINAROS | BENICARLO | PEÑISCOLA | OROPESA DEL MAR | FIGUERES | ROSES | BANYOLES | OLOT | VIC | PERPINYA | RIPOLL | PALAFLUGELL | PALAMOS | BUJARALOZ | CASPE | ALCAÑIZ | BENABARRE | BENASQUE | BINACED | ARTESA DE SEGRE | MONTBLANC | AGER | PONTS | PONT DE SUERT | SOPEIRA | LA POBLA DE SEGUR | RIALP | SORT | LLAVORSI | TREMP | SOLSONA | BERGA | CARDONA | ALTAFULLA | BERET | UNHA | ARTIES | LES | BOSSOST | TAULL | LA MOLINA | GRAN VARILA | CANILLO | ZAIDIN | ORGANYA | MORA D’EBRE | MOLLET DEL VALLES | AEROPORT DE GIRONA | COLLBATO | BELLAGUARDA | LA SEU D’URGELL | AMPOSTA | VILASSAR DE MAR | ANDORRA LA VELLA | MORA BANC | ANDBANK | CREDIT ANDORRA | ALGUAIRE | MENARGUENS | RIALP | ESCALDES | LA | RANADELLA | HOSPITALET DE L’INFANT | JONQUERA | MONTBRIO DEL CAMP | VILOSELL | GOLMES | ALGERRI | MONTGAT | MALGRAT | ALMUDEVAR | TUDELA | ANSERALL | ALFARO | ALCAMPELL | ONTIÑENA | SANTA LINYA | TORNABOUS | ROCALLAURA | VALLBONA DE LES | ONGES | PRAT DEL LLOBRAGAT | TORREFARRERA | BENAVENT | PRADELL | SANPEDOR | CALAHORRA | CORNELLA | SANT CELONI | BOVERA | BORGES BLANQUES | JUNEDA | EL RADO | CASTEJON | ESTERRI | BIELSA | SANTA COLOMA | MONTBLANC | RIUDOMS | AMETLLA DE MAR | L’AMPOLLA | HOSTARIC | BLANES | PALAMOS | L’ALDEA | VILAFORTUNY | ESPLUGA FRANCOLÍ | VINAIXA | VIMBODI | POBLET | CASTELLSERA | PENELLES | BELLMUNT | LA SENTIU | GERB | SANT LLORENÇ | VILANOVA | ALBESA | LA PORTELLA | ROSELLO | VILASANA | BARBENS | ANGLESOLA | VILAGRASSA | LA FULIOLA | MONTGAI | CUBELLS | CUBELLES | CELLERS | TALARN | ALGERRI | TORRELAMEU | SUCS | ALAMUS | ALPICAT | ARBECA | ASCO | REUS | CASTELLO | VALLFOGONA | CORBINS | BALAGUER | OS DE | ALAGUER | ARTESA DE LLEIDA | CERVIA | BINEFAR | VENCILLON | ALFAJARIN | CALATAYUD | JACA | PEÑALBA | SARIÑENA | GRAÑEN | TORRECIUDAD | CANDASNOS | LA ALMUNIA | BERBEGAL | SABIÑANIGO | ALBALATE | ALCAMPELL | BOI | ESPOT | PORTAINE | VALL DE | URIA | EL TARTER | CERDANYA | FORMIGUERES | PANTICOSA | FORMIGAL | BANC SABADELL |’ANDORRA | VALLBANC | ALCARRAS | ALMACELLES | ARCALIS | ARINSAL | PAL | REUS | BARBASTRO | MONZON | PIRINEU ANDORRANO | CERLER | AIGUESTORTES | ESTANY DE SANT | AURICI | GRAU ROIG | GRAUS | TURISMO BENASQUE | BENASQUE | TURISMO VALL D’ARAN | TURISMO ANDORRA | TURISMO ALTA RIBAGORÇA | TURISMO PALLARS JUSA | AEROPUERTO | E TOULOUSE(BLAGNAC) | AEROPUERTO DE TOULOUSE | AEROPUERTO DE TARBES(OSSUN) | AINSA | FRAGA | PARQUE NACIONAL D’ORDESA Y MONTE PERDIDO | PARQUE NACIONAL ’ORDESA | MONTE PERDIDO | CAMPO | DURRO | BARRUERA | ANDORRA LA VELLA | TALARN | TREMP | ABIEGO | ABIZANDA | ADAHUESCA | AGÜERO | AINSA-SOBRARBE | AISA | ALBALATE DE CINCA | ALBALATILLO | ALBELDA | ALBERO ALTO | ALBERO BAJO | ALBERUELA DE TUBO | ALCALA DE GURREA | ALCALA DEL OBISPO | ALCOLEA DE CINCA | ALCUBIERRE | ALERRE | ALFANTEGA | ALMUNIA DE SAN JUAN | ALMUNIENTE | ALQUEZAR | ANGÜES | ANSO | ANTILLON | ARAGÜES DEL PUERTO | AREN | ARGAVIESO | ARGUISAYERBE | AZANUY-ALINS | AZARA | AZLOR | BAELLS | BAILO | BALDELLOU | BALLOBAR | BANASTAS | BARBUES | BARBUNALES | BARCABO | BELVER DE CINCA | BIERGE | BIESCAS | BISAURRI | BISCARRUES | BLECUA Y TORRES | BOLTANA | BONANSA | BORAU | BROTO | CALDEARENAS | CAMPORRELLS | CANAL DE BERDUN | CANFRANC | CAPDESASO | CAPELLA | CASBAS DE HUESCA | CASTEJON DE MONEGROS | CASTEJON DE SOS | CASTEJON DEL PUENTE | CASTELFLORITE | CASTIELLO DE JACA | CASTIGALEU | CASTILLAZUELO | CASTILLONROY | CHALAMERA | CHIA | CHIMILLAS | COLUNGO | ESPLUS | ESTADA | ESTADILLA | ESTOPINAN DEL CASTILLO | FAGO | FANLO | FISCAL | FONZ | FORADADA DEL TOSCAR | FUEVA | GISTAIN | GRADO | GRANEN | GURREA DE GALLEGO | HOZ DE ACA | HOZ Y COSTEAN | HUERTO | IBIECA | IGRIES | ILCHE | ISABENA | JASA | LABUERDA | LALUENGA | LALUEZA | LANAJA | LAPERDIGUERA | LASCELLAS-PONZANO | LASCUARRE | LASPAULES | LASPUNA | LOARRE | LOPORZANO | LOSCORRALES | LUPINEN-ORTILLA | MONESMA Y CAJIGAR | MONFLORITE-LASCASAS | MONTANUY | NAVAL | NOVALES | NUENO | OLVENA | ONTINENA | OSSO DE CINCA | PALO | PENALBA | PENAS DE RIGLOS | PERALTA DE ALCOFEA | PERALTA DE CALASANZ | PERALTILLA | PERARRUA | PERTUSA | PIRACES | PLAN | POLENINO | POZAN DE VERO | PUEBLA DE CASTRO | PUENTE DE MONTANANA | PUENTE LA REINA DE JACA | PUERTOLAS | PUEYO DE ARAGUAS | PUEYO DE SANTA CRUZ | QUICENA | ROBRES | SABINANIGO | SAHUN | SALAS ALTAS | SALAS BAJAS | SALILLAS | SALLENT DE GALLEGO | SAN ESTEBAN DE LITERA | SAN JUAN DE PLAN | SAN MIGUEL DEL CINCA | SANGARREN | SANTA CILIA | SANTA CRUZ DE LA SEROS | SANTA MARIA DE DULCISSANTALIESTRA Y SAN QUILEZ | SARINENA | SECASTILLA | SEIRA | SENA | SENES DE ALCUBIERRE | SESA | SESUE | SIETAMO | SOTONERA | TAMARITE DE LITERA | TARDIENTA | TELLA-SIN | TIERZ | TOLVA | TORLA | TORRALBA DE ARAGON | TORRE LA RIBERA | TORRES DE ALCANADRE | TORRES DE BARBUES | TRAMACED | VALFARTA | VALLE DE BARDAJI | VALLE DE HECHO | VALLE DE LIERP | VELILLA DE CINCA | VERACRUZ | VIACAMP Y LITERA | VICIEN | VILLANOVA | VILLANUA | VILLANUEVA DE SIGENA | YEBRA DE BASA | YESERO | ABELLA DE LA CONCA | AGRAMUNT |AITONA | ALAS I CERC | ALBAGES | ALBATARREC | ALBI | ALCOLETGE | ALINS | ALMATRET | ALOS DE BALAGUER | ALT ANEU | ARRES | ARSEGUEL | AVELLANES I SANTA LINYA | BAIX PALLARS | ARONIA | DE RIALB | BASSELLA | BAUSEN | BELIANES | BELLCAIRE D'URGELL | BELL-LLOC D'URGELL | BELLMUNT D'URGELL | BELLVER DE CERDANYA | BELLVIS | BENAVENT DE SEGRIA | BIOSCA | BORDES | CABANABONA | CABO | CANEJAN | CASTELL DE MUR | CASTELLAR DE LA RIBERA | CASTELLNOU DE SEANA | CASTELLO DE FARFANYA | CAVA | CERVERA | CERVIA DE LES GARRIGUES | CIUTADILLA | CLARIANA DE CARDENER | COGUL | COLL DE NARGO | COMA I LA PEDRA | CONCA DE DALT | ESPLUGA CALBA | ESPOTVESTAMARIUVESTARAS | ESTERRI D'ANEU | ESTERRI DE CARDOS | FARRERA | FIGOLS I ALINYA | FLORESTA | FONDARELLA | FORADADA | FULIOLA | FULLEDA | GAVET DECONCA | GIMENELLS I EL PLA DEFONT | GOSOL | GRANADELLA | GRANJA D'ESCARP | GRANYANELLA | GRANYENA DE LES GARRIGUES | GRANYENA DE SEGARRA | GUIMERA | GUINGUETA D'ANEU | GUIXERS | ISONA I CONCA DELLA | IVARS DE NOGUERA | IVARS D'URGELL | IVORRA | JOSA I TUIXEN | JUNCOSA | LLADORRE | LLARDECANS | LLES DE CERDANYA | LLIMIANA | LLOBERA | MAIALS | MALDA | MASSALCOREIG | MASSOTERES | MIRALCAMP | MOLSOSA | MONTELLA I MARTINET | MONTFERRER I CASTELLBO | MONTOLIU DE LLEIDA | MONTOLIU DE SEGARRA | MONTORNES DE SEGARRA | NALEC | NAUT ARAN | NAVES | ODEN | OLIANA | OLIOLA | OLIUS | OLUGES | OMELLONS | OMELLS DE NA GAIA | OS DE BALAGUER | OSSO DE SIO | PALAU D'ANGLESOLA | PERAMOLA | PINELL DE SOLSONES | PINOS | PLANS DE SIO | POAL | POBLA DE CERVOLES | PONT DE BAR | PONT DE SUERT ONTS | PORTELLA | PRATS I SANSOR | PREIXANA | PREIXENS | PRULLANS | PUIGGROS | PUIGVERD D'AGRAMUNT | PUIGVERD DE LLEIDA | RIBERA D'ONDARA | RIBERA D'URGELLET | RINER | RIU DE CERDANYA | ROSSELLO | SALAS DE PALLARS | SANAUJA | SANT ESTEVE DE LA SARGA | SANT GUIM DE FREIXENET | SANT GUIM DEPLANA | SANT LLORENC DE MORUNYS | SANT MARTI DE RIUCORB | SANT RAMON | SARROCA DE BELLERA | SARROCA DE LLEIDA | SENTERADA | SENTIU DE SIO | SEU D'URGELL | SIDAMON | SOLERAS | SORIGUERA | SOSES | SUDANELL | SUNYER | TALAVERA | TARRES | TARROJA DE SEGARRA | TERMENS | TIRVIA | TIURANA | TORA | TORMS | TORRE DE CABDELLA | TORREFETA I FLOREJACS | TORRES DE SEGRE | TORRE-SERONA | VALL DE BOI | VALL DE CARDOS | VALLBONA DE LES MONGES | VALLFOGONA DE BALAGUER | VALLS D'AGUILAR | VALLS DE VALIRA | VANSA I FORNOLS | VERDU | VIELHA E MIJARAN | VILALLER | VILAMOS | VILANOVA DE BELLPUIG | VILANOVA DEBARCA | VILANOVA DE L'AGUDA | VILANOVA DE MEIA | VILANOVA DE SEGRIA | VILA-SANA | ABRERA | AGUILAR DE SEGARRA | AIGUAFREDA | ALELLA | ALPENS | AMETLLA DEL VALLES | ARENYS DE MAR | ARENYS DE MUNT | ARGENCOLA | ARGENTONA | ARTES | AVIA | AVINYO | AVINYONET DEL PENEDES | BADIA DEL VALLES | BAGA | BALENYA | BALSARENY | BARBERA DEL VALLES | BEGUES | BELLPRAT | BIGUES I RIELLS | BORREDA | BRUC | BRULL | CABANYES | CABRERA D'ANOIA | CABRERA DE MAR | CABRILS | CALDERS | CALDES DE MONTBUI | CALDES | 'ESTRAC | CALLDETENES | CALLUS | CALONGE DE SEGARRA | CAMPINS | CANET DE MAR | CANOVELLES | CANOVES I SAMALUS | CANYELLES | CAPELLADES | CAPOLAT | CARDEDEU | CARME | CASSERRES | CASTELL DE L'ARENY | CASTELLAR DE N'HUG | CASTELLAR DEL RIU | CASTELLAR DEL VALLES | CASTELLBELL I EL VILAR | CASTELLBISBAL | CASTELLCIR | CASTELLET I A GORNAL | CASTELLFOLLIT DE RIUBREGOS | CASTELLFOLLIT DEL BOIX | CASTELLGALI | CASTELLNOU DE BAGES | CASTELLOLI | CASTELLTERCOL | CASTELLVI DE LA MARCA | CASTELLVI DE ROSANES | CENTELLES | CERCS | CERDANYOLA DEL VALLES | CERVELLO | COLLSUSPINA | COPONS | CORBERA DE LLOBREGAT | CORNELLA DE LLOBREGAT | DOSRIUS | ESPARREGUERA | ESPLUGUES DE LLOBREGAT | ESPUNYOLA | ESTANY | FIGARO-MONTMANY | FIGOLS | FOGARS DE LA SELVA | FOGARS DE MONTCLUS | FOLGUEROLES | FONOLLOSA | FONT-RUBI | FRANQUESES DEL VALLES | GAIA | GALLIFA | GARRIGA | GAVA | GELIDA | GIRONELLA | GISCLARENY | GRANERA | GUALBA | GUARDIOLA DE BERGUEDA | GURB | HOSPITALET DE LLOBREGAT | HOSTALETS DE PIEROLA | JORBA | LLACUNA | LLAGOSTA | LLICA D'AMUNT | LLICA DE VALL | LLINARS DEL VALLES | LLUCA | MALGRAT DE MAR | MALLA | MANLLEU | MANRESA | MARGANELL | MARTORELLES | MASIES DE RODA | MASIES DE VOLTREGA | ASNOU | MASQUEFA | MATADEPERA | MEDIONA | MOIA | MONISTROL DE CALDERS | MONISTROL DE MONTSERRAT | MONTCADA I REIXAC | MONTCLAR | MONTESQUIU | MONTMAJOR | MONTMANEU | MONTMELO | MONTORNES DEL VALLES | MONTSENY | MUNTANYOLA | MURA | NAVARCLES | NAVAS | NOU DE BERGUEDA | ODENA | OLERDOLA | OLESA DE BONESVALLS | OLESA DE MONTSERRAT | OLIVELLA | OLOST | OLVAN | ORIS | ORISTA | ORPI | ORRIUS | PACS DEL PENEDES | PALAFOLLS | PALAU-SOLITA I PLEGAMANS | PALLEJA | PALMA DE CERVELLO | PAPIOL | PARETS DEL VALLES | PERAFITA | PIERA | PINEDA DE MAR | PLA DEL PENEDES | POBLA DE CLARAMUNT | POBLA DE LILLET | POLINYA | PONT DE VILOMARA I ROCAFORT | PONTONS | PRAT DE LOBREGAT | PRATS DE LLUCANES | PRATS DE REI | PREMIA DE DALT | PREMIA DE MAR | PUIGDALBER | PUIG-REIG | PUJALT | QUAR | RAJADELL | RELLINARS | RIPOLLET | ROCA DEL VALLES | RODA DE TER | RUBIO | RUPIT I PRUIT | SAGAS | SALDES | SALLENT | SANT ADRIA DE BESOS | SANT AGUSTI DE LLUCANES | SANT ANDREU DE LA BARCA | SANT ANDREU DE LLAVANERES | SANT ANTONI DE VILAMAJOR | SANT BARTOMEU DEL GRAU | SANT BOI DE LLOBREGAT | SANT BOI DE LLUCANES | SANT CEBRIA DE VALLALTA | SANT CLIMENT DE LLOBREGAT | SANT CUGAT DEL VALLES | SANT CUGAT SESGARRIGUES | SANT ESTEVE DE PALAUTORDERA | SANT STEVE SESROVIRES | SANT FELIU DE CODINES | SANT FELIU DE LLOBREGAT | SANT FELIU SASSERRA | SANT FOST DE CAMPSENTELLES | SANT RUITOS DE BAGES | SANT HIPOLIT DE VOLTREGA | SANT ISCLE DE VALLALTA | SANT JAUME DE FRONTANYA | SANT JOAN DE VILATORRADA | SANT JOAN DESPI | SANT JULIA DE CERDANYOLA | SANT JULIA DE VILATORTA | SANT JUST DESVERN | SANT LLORENC D'HORTONS | SANT LLORENC SAVALL | SANT MARTI D'ALBARS | SANT MARTI DE CENTELLES | SANT MARTI DE TOUS | SANT MARTI SARROCA | SANT MARTI SESGUEIOLES | SANT MATEU DE BAGES | SANT PERE DE RIBES | SANT PERE DE RIUDEBITLLES | SANT PERE DE TORELLO | SANT PERE DE VILAMAJOR | SANT PERE SALLAVINERA | SANT POL DE MAR | SANT QUINTI DE MEDIONA | SANT QUIRZE DE BESORA | SANT QUIRZE DEL VALLES | SANT QUIRZE SAFAJA | SANT SADURNI D'ANOIA | SANT SADURNI D'OSORMORT | SANT SALVADOR DE GUARDIOLA | SANT VICENC DE CASTELLET | SANT VICENC DE MONTALT | SANT VICENC DE TORELLO | SANT VICENC DELS HORTS | SANTA CECILIA DE VOLTREGA | SANTA COLOMA DE CERVELLO | SANTA COLOMA DE RAMENET | SANTA EUGENIA DE BERGA | SANTA EULALIA DE RIUPRIMER | SANTA EULALIA DE RONCANA | SANTA FE DEL PENEDES | SANTA MARGARIDA DE MONTBUI | SANTA MARGARIDA I ELS MONJOS | SANTA MARIA DE BESORA | SANTA MARIA DE CORCO | SANTA MARIA DE MARTORELLES | SANTA MARIA DE MERLES | SANTA MARIA DE MIRALLES | SANTA MARIA DE PALAUTORDERA | SANTA MARIA D'OLO | SANTA PERPETUA DE MOGODA | SANTA SUSANNA | SANTPEDOR | SENTMENAT | SEVA | SOBREMUNT | SORA | SUBIRATS | SURIA | TAGAMANENT | TALAMANCA | TARADELL | TAVERNOLES | TAVERTET | TEIA | TIANA | TONA | TORDERA | TORELLO | TORRE DE CLARAMUNT | TORRELAVIT | TORRELLES DE FOIX | TORRELLES DE LLOBREGAT | ULLASTRELL | VACARISSES | VALLBONA D'ANOIA | VALLCEBRE | VALLGORGUINA | VALLIRANA | VALLROMANES | VECIANA | VILADA | VILADECANS | VILADECAVALLS | VILAFRANCA DEL PENEDES | VILALBA SASSERRA | VILANOVA DE SAU | VILANOVA DEL CAMI | VILANOVA DEL VALLES | VILASSAR DE DALT | VILOBI DEL PENEDES | VIVER I SERRATEIX | AIGUAMURCIA | ALBINYANA | ALBIOL | ALCANAR | ALCOVER | ALDEA | ALDOVER | ALEIXAR | ALFARA DE CARLES | ALFORJA | ALIO | ALMOSTER | AMPOLLA | ARBOC | ARBOLI | ARGENTERA | ARNES | BANYERES DEL PENEDES | BARBERA DE LA CONCA | BATEABELLMUNT DEL PRIORAT | BELLVEI | BENIFALLET | BENISSANET | BISBAL DE FALSET | BISBAL DEL PENEDES | BLANCAFORT | BONASTRE | BORGES DEL CAMP | BOT | BOTARELL | BRAFIM | CABACES | CABRA DEL CAMP | CAMARLES | CAMBRILS | CAPAFONTS | CAPCANES | CASERES | CASTELLVELL DEL CAMP | CATLLAR | COLLDEJOU | CONESA | CONSTANTI | CORBERA D'EBRE | CORNUDELLA DE MONTSANT | CREIXELL | CUNIT | DELTEBRE | DUESAIGÜES | ESPLUGA DE FRANCOLI | FALSET | FATARELLA | FEBRO | FIGUERA | FIGUEROLA DEL CAMP | FORES | FREGINALS | GALERA | GANDESA | GARCIA | GARIDELLS | GINESTAR | GODALL | GRATALLOPS | GUIAMETS | HORTA DE SANT JOAN | LLOAR | LLORAC | LLORENC DEL PENEDES | MARCA | MARGALEF | MAS DE BARBERANS | MASDENVERGE | MASLLORENC | MASO | MASPUJOLS | MASROIG | MILA | MIRAVET | MOLAR | MONTFERRI | MONTMELL | MONT-RAL | MONT-ROIG DEL CAMP | MORA D'EBRE | MORA LA NOVA | MORELL | MORERA DE MONTSANT | NOU DE GAIA | NULLES | PALLARESOS | PALMA D'EBRE | PASSANANT I BELLTALL | PAÜLS | PERAFORT | PERELLO | PILES | PINELL DE BRAI | PIRA | PLA DE SANTA MARIA | POBLA DE MAFUMET | POBLA DE MASSALUCA | POBLA DE MONTORNES | POBOLEDA | PONT D'ARMENTERA | PONTILS | PORRERA | PRADELL DE LA TEIXETA | PRADES | PRAT DE COMTE | PRATDIP | PUIGPELAT | QUEROL | RASQUERA | RENAU | RIBA | RIBA-ROJA D'EBRE | RIERA DE GAIA | RIUDECANYES | RIUDECOLS | ROCAFORT DE QUERALT | RODA DE BARA | RODONYA | ROQUETES | ROURELL | SALOMO | SALOU | SANT CARLES DE LA RAPITA | SANT JAUME DELS DOMENYS | SANT JAUME D'ENVEJA | SANTA BARBARA | SANTA COLOMA DE QUERALT | SANTA OLIVA | SARRAL | SAVALLA DEL COMTAT | SECUITA | SELVA DEL CAMP | SENAN | SENIA | SOLIVELLA | TIVENYS | TIVISSA | TORRE DE FONTAUBELLA | TORRE DE L'ESPANYOL | TORREDEMBARRA | TORROJA DEL PRIORAT | ULLDECONA | ULLDEMOLINS | VALLCLARA | VALLFOGONA DE RIUCORB | VALLMOLL | VANDELLOS I L'HOSPITALET DE L'INFANT | VENDRELL ESPELLA DE GAIA | VILABELLA | VILALBA DELS ARCS | VILALLONGA DEL CAMP | VILANOVA DE PRADES | VILANOVA D'ESCORNALBOU | VILAPLANA | VILA-RODONA | VILA-SECA | VILAVERD | VILELLA ALTA | VILELLA BAIXA | VIMBODI I POBLET | VINEBRE | VINYOLS I ELS ARCS | XERTA";
           
    $array_poblacions = explode(" | ", $poblacions);
    
    for ($i=0; $i<count($array_poblacions); $i++){
        $my_post = array();
		//Si volem que siguin pagines -> $my_post['post_type'] = 'page';//
          $my_post['post_title'] = 'Taxi en '.$array_poblacions[$i];
          $my_post['post_content'] = '<div style="color:black;">Servicio de taxi des de '.$array_poblacions[$i].' a otras poblaciones, aeropuertos...<br> Telefono 632 650 823 Llamar de 06:00 - 24:00 Solo servicios hacia fuera de la ciudad.<table style="border: 2px solid black;">
                        <tbody>
                        <tr style="border: 2px solid black;">
                        <td><img class="wp-image-6038 aligncenter" src="http://taxis-lleida.es/wp-content/uploads/2018/04/whatsapp-300x192.png" alt="" width="105" height="66" /></td>
                        <td style="border: 2px solid black;">  WhatsApp 632 650 823</td>
                        </tr>
                        <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;"><img class="wp-image-6037 aligncenter" src="http://taxis-lleida.es/wp-content/uploads/2018/04/24.png" alt="" width="48" height="45" /></td>
                        <td>  Disponibilidad taxi 24 horas</td>
                        </tr>
                        </tbody>
                        </table>
                        <img class="alignnone size-full wp-image-6020" src="http://taxis-lleida.es/wp-content/uploads/2018/04/taxi24b.png" alt="" width="256" height="256" /></div>';

          $my_post['post_status'] = 'publish';
          $my_post['post_author'] = 1;
          $my_post['post_category'] = array(8,39);

          if ( wp_insert_post( $my_post ) ){
              echo "Entrada Creada";
          }else{
              echo "Hi ha hagut un error al crear lentrada";
          } 
    }
    //print_r($array_poblacions);
}
/**************************************CONTROLAR ENVIO CORREUS AMB PLUGUIN CONTACT FORM I CRON*********************************************/
// CRON QUE ENVIARÀ UNA CONFIRMACIÓ ALS QUE OMLEN EL FORMULARI DE ENVIAR CURRICULUM
// Si envien el curriculum més tard de les 12 ho enviarà el dia següent.

add_action('init', 'custom_plugin_function_eventoos');
function custom_plugin_function_eventoos() {
    if (wp_next_scheduled('comprobarenvios') == false) {
        wp_schedule_event(time(), 'wp_wc_updater_cron_interval', 'comprobarenvios');
    }
    add_action('comprobarenvios', 'custom_plugin_functionses');
}

// ---- Execute custom plugin function.
function custom_plugin_functionses() {
	
	//Array on aniran els formularis pendents de envia confirmacio
	$formularisBD=array();	

	//INICIEM BD
	global $wpdb;

	//Consultem la BD
	$SQL_Formularis="SELECT * FROM dljjd_db7_forms where form_post_id in (3227,2994,1178,1153) and enviat_resposta != 1";
	$rowFormularis = $wpdb->get_results($SQL_Formularis);

	for ($i=0; $i<count($rowFormularis);$i++){
		$correu= explode('"', $rowFormularis[$i]->form_value);
		//print_r($correu);

		
		$horaActualServidor = date('H:i:s', strtotime('2 hour'));
		$horaLimit = "12:00:00";

		if ($horaActualServidor <= strtotime($horaLimit)){
			array_push($formularisBD, array('id_formulari'=>$rowFormularis[$i]->form_id,'nom' => $correu[7],'email' => $correu[11], 'enviat_resposta'=>$rowFormularis[$i]->enviat_resposta));
		}
	}

	if(count($formularisBD) > 0){
		for ($i=0; $i<count($formularisBD);$i++){

			$text = 'Hola '.$formularisBD[$i]['nom'].'<br><br>';
			$text .= 'Muchas gracias por enviar el CV a PAMPOLS y por tu interés por formar parte de nuestro equipo.<br><br>'; 
			$text .= 'Lo tendremos en cuenta para las vacantes que tengamos y, en el caso de que tu perfil encaje, contactaremos contigo para concertar una entrevista.<br><br>'; 
		 	$text .= 'Saludos, ';
	
			$to = $formularisBD[$i]['email'];
                        $subject = 'Curriculum Recibido!';
                        $body = $text;
                        $headers = array('Content-Type: text/html; charset=UTF-8');
			
			$mailResult = false;
                        $mailResult = wp_mail( $to, $subject, $body, $headers );
			
			if ($mailResult==TRUE){
				$wpdb->get_results('update dljjd_db7_forms set enviat_resposta=1 where form_id ='.$formularisBD[$i]['id_formulari']);
			}else{
				$wpdb->get_results('update dljjd_db7_forms set enviat_resposta=2 where form_id ='.$formularisBD[$i]['id_formulari']);
			}
		
				
		}
	}

}
/**************************************AFEFIR DESCRIPCIO CATEGORIA PRODUCTES*********************************************/
function woocommerce_after_shop_loop_item_title_short_description() {
	global $product;
	if ( ! $product->post->post_excerpt ) return;
	?>
	<div itemprop="description">
		<?php //echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) 
		echo substr($product->short_description, 0, 12)."<br>";
		echo $product->description;
		?>
		
	</div>
	<?php
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);
/**************************************AFEGIR COLUMNES TAULES WORDPRESS (bigjeans)****************************************/

// GET L'ATRIBUT COLOR
function get_atribut_color($post_ID) {
	$producte_atribut = get_the_terms( $post, 'pa_color' );
	return $producte_atribut;
}
// AFEGIM LA COLUMNA
function crear_thead_columna($defaults) {
	$defaults['AtributColor'] = 'AtributColor';
	return $defaults;
}
// MOSTREM LES DADES A LA COLUMNA
function mostrar_contingut_columna($column_name, $post_ID) {
	if ($column_name == 'AtributColor') {
		$colors = get_atribut_color($post_ID);
		if ($colors) {
			$text_td = "COLORS: ";
			foreach ( $colors as $color ) {
				$text_td .= '['.$color->name.']';
			}	
		}else{
			$text_td = "FALTA COLOR";
		}
		echo $text_td;
	}
}

add_filter('manage_posts_columns', 'crear_thead_columna');
add_action('manage_posts_custom_column', 'mostrar_contingut_columna', 10, 2);

//Per les que volem amagar
function filtre_columnes_productes( $columns ) {

	unset($columns['date']);
	unset($columns['product_tag']);
	unset($columns['wpseo-score-readability']);
	unset($columns['wpseo-score']);
	unset($columns['wpseo-links']);
	unset($columns['wpseo-metadesc']);
	unset($columns['wpseo-focuskw']);
	
	return $columns;
}
add_filter( 'manage_edit-product_columns', 'filtre_columnes_productes', 10, 1 );

//Fer que surtin les subcategories de la categoria actual al widget de l'esquerra

add_filter('woocommerce_product_categories_widget_args', 'widget_product_categories_list_args', 10, 1);
function widget_product_categories_list_args( $list_args ) {
    global $wp_query;

    // Only for category archives pages
    if ( is_tax( $list_args['taxonomy'] ) ):
        // Get current category
        $current_cat = $wp_query->queried_object;

        // Get all Included category terms IDs in the widget
        $included_ids = explode( ',', $list_args['include'] );

        // Get All Childrens Ids from parent term or from current term
        if($current_cat->parent != 0 )
            $childrens = get_term_children( $current_cat->parent, $list_args['taxonomy'] );
        else
            $childrens = get_term_children( $current_cat->term_id, $list_args['taxonomy'] );

        // Loop through Children term Ids and add them to existing included ones
        foreach( $childrens as $child )
            $included_ids[] = $child;

        // Replace included product category term IDs in the $args array
        $list_args['include'] = $included_ids;
    endif;

    return $list_args;
}

//Ficar el percentatge a la pagina del producte

/*add_filter( 'woocommerce_get_price_html', 'change_displayed_sale_price_html', 10, 2 ); function change_displayed_sale_price_html( $price, $product ) { 
	// Only on sale products on frontend and excluding min/max price on variable products 
	if( $product->is_on_sale() && ! is_admin() && ! $product->is_type('variable')){ 
		// Get product prices 
		$regular_price = (float) $product->get_regular_price(); 
		// Regular price 
		$sale_price = (float) $product->get_price(); 
		// Active price (the "Sale price" when on-sale) // "Saving Percentage" calculation and formatting $precision = 1; // Max number of decimals
		$saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 1 ) . '%'; 
		// Append to the formated html price 
		$price .= sprintf( __('<ins><span class="percentatge-producte"> -%s</span></ins>', 'woocommerce' ), $saving_percentage ); } return $price; } */

/**************************************ENCUAR ESTILS PROPIS****************************************/

function scripts_css_compsaonline() {

    $versio = "1.0.0";

	wp_enqueue_script( 'script-cookies', get_template_directory_uri() . '/compsaonline/js/jquery.cookie.js', array(), $versio);

	wp_enqueue_script( 'script-magnific-popup', get_template_directory_uri() . '/compsaonline/js/magnific-popup/jquery.magnific-popup.min.js', array(), $versio );
	wp_enqueue_style( 'style-magnific-popup', get_template_directory_uri() . '/compsaonline/js/magnific-popup/magnific-popup.css', array(), $versio );

	
	
    wp_enqueue_style( 'style-compsaonline', get_template_directory_uri(). '/compsaonline/my-style.css', array(), $versio);
    wp_enqueue_script( 'script-compsaonline', get_template_directory_uri() . '/compsaonline/js/my-scripts.js', array(), $versio );

    wp_localize_script('script-compsaonline', 'script_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php'), // VEURE SI PINTE LA URL AMB HTTPS
            'host' => ($_SERVER['SERVER_PORT'] == 443) ? "https://".$_SERVER["HTTP_HOST"] : "http://".$_SERVER["HTTP_HOST"],
			'esPaginaInici' => is_front_page(),
			'idiomaActual' => ICL_LANGUAGE_CODE,
			/*
            'idioma' =>  ICL_LANGUAGE_CODE,
            'codisArticlesTots' => $codisArticlesTots
			*/
        )
    );
	
}

add_action( 'wp_enqueue_scripts', 'scripts_css_compsaonline' );

//Metode dos
function load_my_script(){
    wp_register_script( 
        'compsaonlinejs', 
        get_template_directory_uri() . '/js/compsaonline.js', 
        array( 'jquery' )
    );
    wp_enqueue_script( 'compsaonlinejs' );
	wp_register_style( 'fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'fontAwesome' );
	wp_register_script('selectelement', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js');
	wp_enqueue_script( 'selectelement' );
}
add_action('wp_enqueue_scripts', 'load_my_script');
wp_enqueue_style('compsaonline','/wp-content/themes/kallyas/css/compsaonline.css');

/***************************ELIMINAR REDIMENCIONAR FOTOS**************************************/
function remove_image_sizes( $sizes, $metadata ) {
    return [];
}
add_filter( 'intermediate_image_sizes_advanced', 'remove_image_sizes', 10, 2 );

/*******************************ALTERNAR BANERS POP UP****************************************/
// S'ha de crear un pop up amb una imatge i tot normal
// Afegir script js que fara que la imatge mostrada a vegades sera diferent

<script type="text/javascript"> 
    var num = Math.floor(Math.random() * 2) + 1;
    //console.log(num);
	if (num == 1){
	        jQuery('#foto').attr('src', 'http://www.balaguer.tv/wp-content/uploads/2018/09/Cartel_X_MontgaiMàgicbanner-.jpg');
            jQuery('#enllas').attr('href', 'http://www.montgaimagic.cat/');
	}
	//Seleccionar elements de una mateixa classe
	$('.ruta_origen').eq(2)
	//Seleccionar totes les classes amb JQUERY
	jQuery(".evo-post-date").each(function(index, elementUl){
		//CODI..
	});
</script>
		
/*****************************MODIFICAR CHECKOUT**********************************************/

//Afegir contingut al chekout
add_action( 'woocommerce_before_checkout_form', 'add_content_woocommerce_before_checkout_form', 10);
function add_content_woocommerce_before_checkout_form(){
	echo "hola";
}

// Afegir el filtre al checkout
add_filter( 'woocommerce_checkout_fields' , 'my_override_checkout_fields' );

function my_override_checkout_fields( $fields ) {
		$fields['order']['order_comments']['required'] = 1;
		/*echo "<pre>";
		print_r($fields);
		echo "</pre>";*/ 
     return $fields;
}

/*****************************JS SCROLL CONTROLLER*********************************************/
//Depen de la següent llibreria:
wp_register_script('selectelement', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js');
wp_enqueue_script( 'selectelement' );

const waypoints = [
	{
		id: 'toptotal',
		handler(direction) {
			treureRalletaMenus();
			console.log('ep');
		}
	}
];

waypoints.forEach(({ id, handler }) => (
	new Waypoint({
		element: document.getElementById(id),
		handler,
		offset: 200 // añade un margen superior opcional
	})
));
/******************************DETECTAR PANTALLA MOBIL O PC*********************************/
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
   console.log('Esto es un dispositivo móvil');
   jQuery('.slider_pc').css('display','none');
}else{
   console.log('Esto es un PC');
   jQuery('.slider_mobil').css('display','none');
}
/******************************CAPTURA PANTALLA DE UNA WEB URL I FICAR-LA COM A THUMBNAIL***/

function crear_entrades_automatiques(){
    
    define('UPLOAD_DIR', get_template_directory().'/compsaonline/');
	//Mirem quants posts tenim
	global $wpdb;
	
	//$post_sense_imatge = array('163');
	
	
	
	//for ($i=0;$i<count($post_sense_imatge);$i++){
		$posts = $wpdb->get_results( "SELECT * FROM `wp_posts` INNER JOIN `co26435_term_relationships` ON wp_posts.ID = co26435_term_relationships.object_id where wp_posts.post_status='publish' and wp_posts.post_type='post' and co26435_term_relationships.term_taxonomy_id = 2 and wp_posts.ID=17684");	
		foreach ($posts as $post) {
		
		//A cada post li fiquem el thumbnail corresponent
		
		    $contingut = $post->post_content;
			
			$contingut = strval($contingut);
			$contignut = '';
			
			$contingut_arr = explode(" ",$contingut);
			
			$url_arr = explode(">",end($contingut_arr));
			
			$url = $url_arr[1];
			
			$url =str_replace("<a", "", $url);
			$url =str_replace("</div", "", $url);
			$url =str_replace("</span", "", $url);
			$url =str_replace("</a", "", $url);
			$url =str_replace("http://www.", "", $url);
			$url =str_replace("https://www.", "", $url);
			$url =str_replace("https://", "", $url);
			$url =str_replace("http://", "", $url);
			$url =str_replace("/", "", $url);
			$url =str_replace("www.", "", $url);
			echo $url;
			
			$screenshot = 'http://api.webthumbnail.org/?width=1200&height=800&format=jpg&url='.$url;
			
			
			//Guardem la imatge al servidor
			$file = UPLOAD_DIR .'imatge.png';
			$content = file_get_contents($screenshot);
			file_put_contents($file, $content);
			
			echo "<img src=".$screenshot."/>";
			
			
			
			//La pujem al wordpress de manera que obrtindrem el ID
			$filename = 'imatge.png';
				$upload_file = wp_upload_bits( $filename, null, @file_get_contents( $file ) );
				if ( ! $upload_file['error'] ) {
					// if succesfull insert the new file into the media library (create a new attachment post type).
					$wp_filetype = wp_check_filetype($filename, null );

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_parent'    => $post->ID,
						'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);

					$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post->ID );

					if ( ! is_wp_error( $attachment_id ) ) {
						// if attachment post was successfully created, insert it as a thumbnail to the post $post_id.
						require_once(ABSPATH . "wp-admin" . '/includes/image.php');

						$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );

						wp_update_attachment_metadata( $attachment_id,  $attachment_data );
						set_post_thumbnail( $post->ID, $attachment_id );
					}
				}

		//}
		//}
	}
    
}
/******************************DESACTIVAR TENDA WOOCOMMERCE TEMPORALMENT***/

add_action( 'init', 'bbloomer_hide_price_add_cart_not_logged_in' );
  
function bbloomer_hide_price_add_cart_not_logged_in() {
   
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
   
}

/******************************ACTIVAR CUPÓ DESCOMPTE PRIMERA COMPRA WORDPRESS***/

add_action( 'woocommerce_before_checkout_form', 'aplicar_cupo_primera_compra' );
add_action( 'woocommerce_before_cart', 'aplicar_cupo_primera_compra' );

function aplicar_cupo_primera_compra() {
	$coupon_code = 'holatrufas';
	if(is_user_logged_in()) {
		
		$customer_orders = get_posts( array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'meta_value'  => get_current_user_id(),
			'post_type'   => wc_get_order_types(),
			'post_status' => array_keys( wc_get_order_statuses() ),
		) );
		
		if(count($customer_orders) <= 0) {
			if ( WC()->cart->has_discount( $coupon_code ) ) return;
			WC()->cart->apply_coupon( $coupon_code );
			wc_print_notices();
		}
	}
}

/**PRESTASHOP CATEGORIES TPL**/

{foreach from=Product::getProductCategoriesFull(Tools::getValue('id_product')) item=cat}
 	{if $cat.name == 'Zapatos'}
		<a class='guia_talles_product_variants_tpl' href='https://lopite.com/es/content/14-guia-de-tallas' target='_blank' style='margin-top:10px;'><img src='https://lopite.com/themes/bos_ocbee/assets/img/guia.jpg' width='100'>Guia de Tallas</a>
		{break}
	{/if}
    
{/foreach}

/**PRESTASHOP PRODUCTES BD**/
//Eliminar productes de la base de dades directament
//Delete
DELETE ps_product, ps_product_lang, ps_manufacturer FROM ps_product  
LEFT JOIN ps_product_lang ON ps_product.id_product=ps_product_lang.id_product
LEFT JOIN ps_manufacturer ON ps_product.id_manufacturer=ps_manufacturer.id_manufacturer
WHERE ps_product.active=1 AND ps_product_lang.id_lang=3 and ps_manufacturer.name='Balmain'
//Select
select p.id_product AS ID,p.reference AS REFERENCIA,pl.name AS NOMBRE ,pm.name AS FABRICANTE, p.price AS PRECIO FROM ps_product p 
LEFT JOIN ps_product_lang pl ON p.id_product=pl.id_product
LEFT JOIN ps_manufacturer pm ON p.id_manufacturer=pm.id_manufacturer
WHERE p.active=1 AND pl.id_lang=3
//UPDATE
SELECT p.id_product, p.id_category_default, pl.name from ps_product_shop p LEFT JOIN ps_product_lang pl ON p.id_product=pl.id_product where id_category_default = 208
SELECT p.id_product, p.id_category_default, pl.name from ps_product p LEFT JOIN ps_product_lang pl ON p.id_product=pl.id_product where id_category_default = 208
update ps_product_shop p LEFT JOIN ps_product_lang pl ON p.id_product=pl.id_product set p.id_category_default = 36 where p.id_category_default = 208 and pl.name like '%pantalon%'
update ps_product p LEFT JOIN ps_product_lang pl ON p.id_product=pl.id_product set p.id_category_default = 36 where p.id_category_default = 208 and pl.name like '%pantalon%'	
# productes amb combinacions que no tenen referencia SELECT a.id_product, a.id_product_attribute, l.name FROM indikid.prstshp_product_attribute a LEFT JOIN prstshp_product_lang l ON l.id_product = a.id_product where a.reference = '' AND l.id_lang = 1
# productes simples que no tenen referencia SELECT p.id_product, l.name FROM indikid.prstshp_product p LEFT JOIN prstshp_product_attribute a on a.id_product = p.id_product LEFT JOIN prstshp_product_lang l ON l.id_product = p.id_product where p.reference = '' AND a.id_product_attribute is null group by id_product

	
/**PLESK FER QUE CARREGUI AMB ELS ENLLAÇOS PERMANENTS**/
	configuracion del apache o nginx
if (!-e $request_filename) {
	set $test P;
}
if ($uri !~ ^/(plesk-stat|webstat|webstat-ssl|ftpstat|anon_ftpstat|awstats-icon|internal-nginx-static-location)) {
	set $test "${test}C";
}
if ($test = PC) {
	rewrite ^/(.*)$ /index.php?$1;
}