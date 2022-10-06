<?php

/*

Vanilla JS WebComponent's Toolkit
Copyright (C) 2019  Matías Gastón Santiago

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

//----------------------------------------Request Process---------------------------------------

$input = json_decode( file_get_contents('php://input') );


//-------------------------------- Simulation of requested resource ----------------------------

$response = array(
	array("name"=>"Wanda","email"=>"ante.ipsum.primis@Inmipede.com","birthday"=>"21/04/19","salary"=>"$8093.30","id"=>"D76E6317-9CC4-6381-17A8-69D3BDC51655"),
	array("name"=>"India","email"=>"orci.Ut.sagittis@mollisnec.org","birthday"=>"25/04/19","salary"=>"$4073.36","id"=>"F05C922F-732F-3005-C575-3BD193701CC9"),
	array("name"=>"Oprah","email"=>"aliquam@nisl.co.uk","birthday"=>"23/11/19","salary"=>"$3146.87","id"=>"8B066E41-D7CB-0A78-E482-1644937116FE"),
	array("name"=>"Oprah","email"=>"aliquam@nisl.co.uk","birthday"=>"23/11/19","salary"=>"$3146.87","id"=>"8B066E41-D7CB-0A78-E482-1644937116FE"),
	array("name"=>"Demetria","email"=>"tincidunt.orci@Quisque.org","birthday"=>"24/11/19","salary"=>"$1630.67","id"=>"0525AA08-FF86-11A8-81FF-68A1F19974CA"),
	array("name"=>"Mona","email"=>"vel.sapien.imperdiet@inhendreritconsectetuer.org","birthday"=>"25/11/18","salary"=>"$8934.27","id"=>"FD108E53-228A-FC92-6FFE-76B0B24AA832"),
	array("name"=>"Kirby","email"=>"nunc@diamdictum.org","birthday"=>"11/09/18","salary"=>"$7723.87","id"=>"8D800DF2-468C-B6B7-D29A-D67E00714960"),
	array("name"=>"Hadley","email"=>"justo.Praesent@felisadipiscing.com","birthday"=>"12/09/19","salary"=>"$6957.54","id"=>"B3A8BFC9-E5B1-AC2C-8F45-0694727D0EC2"),
	array("name"=>"Melinda","email"=>"ut.nisi.a@Curabitur.edu","birthday"=>"19/06/18","salary"=>"$2038.21","id"=>"B0BE9CE8-1703-0735-E3B4-184554CFE4C7"),
	array("name"=>"Nicole","email"=>"lorem@vulputate.edu","birthday"=>"25/03/20","salary"=>"$4259.29","id"=>"09B2B291-69BE-CA6F-08B2-855055C1EBA0"),
	array("name"=>"Alisa","email"=>"elit.pretium@malesuada.co.uk","birthday"=>"31/05/19","salary"=>"$6811.24","id"=>"4D0BB655-534C-D2F1-F7F1-4BF967348E0E"),
	array("name"=>"Lunea","email"=>"Integer.mollis@Donectemporest.ca","birthday"=>"25/12/18","salary"=>"$7838.99","id"=>"3E9F85FD-9C85-D37C-0DC8-FDB0632EED0E"),
	array("name"=>"Juliet","email"=>"sollicitudin.a@dictumeu.co.uk","birthday"=>"20/03/20","salary"=>"$3141.13","id"=>"74127402-BB0A-68BB-6135-72D77C16F4DA"),
	array("name"=>"Sacha","email"=>"Donec.egestas.Aliquam@magnaSed.edu","birthday"=>"31/01/20","salary"=>"$5446.19","id"=>"87C80E18-010E-0235-971B-2F79B9A929A4"),
	array("name"=>"Emi","email"=>"enim.nec@sagittisaugueeu.com","birthday"=>"18/12/19","salary"=>"$3760.94","id"=>"799E8CE7-EDE3-7499-6430-27674077D7DA"),
	array("name"=>"Rebecca","email"=>"Nam.consequat.dolor@Donec.ca","birthday"=>"02/05/20","salary"=>"$4454.84","id"=>"F623B3C6-32C4-1B8E-F4A0-37B6499981E9"),
	array("name"=>"Quail","email"=>"varius.orci@eu.edu","birthday"=>"24/07/18","salary"=>"$8736.61","id"=>"C7E6F8ED-9267-92D8-2AF0-7B71033A29FD"),
	array("name"=>"Rae","email"=>"mattis.velit.justo@luctussitamet.net","birthday"=>"09/02/20","salary"=>"$7200.87","id"=>"602A9C5D-10C3-6F12-7268-DE02113596DC"),
	array("name"=>"Orli","email"=>"Fusce.aliquet.magna@quispede.co.uk","birthday"=>"02/02/19","salary"=>"$3072.14","id"=>"ED89AE73-E79B-BC1C-0B27-39EA37289141"),
	array("name"=>"Quyn","email"=>"malesuada.augue.ut@Mauris.net","birthday"=>"13/07/19","salary"=>"$2424.64","id"=>"D586CC73-49AA-4B8F-79F9-3174FB247710"),
	array("name"=>"Cameron","email"=>"lorem@nulla.edu","birthday"=>"29/04/19","salary"=>"$6389.39","id"=>"6F7C3AD4-96DA-1B4C-6F40-FA428234CDE1"),
	array("name"=>"Anastasia","email"=>"ultricies.ligula.Nullam@etultricesposuere.org","birthday"=>"16/09/19","salary"=>"$7832.66","id"=>"51C52E7E-C19D-BF8E-DF9A-D3DB94D0C985"),
	array("name"=>"Larissa","email"=>"ornare@congueIn.ca","birthday"=>"26/09/19","salary"=>"$2481.62","id"=>"827F935C-65B0-B604-AB60-E24E89793579"),
	array("name"=>"Macy","email"=>"scelerisque.scelerisque@magnis.net","birthday"=>"02/05/19","salary"=>"$6232.91","id"=>"94CC23EC-1C4A-7204-AE05-35830B119D17"),
	array("name"=>"Lael","email"=>"faucibus.orci@eros.edu","birthday"=>"19/02/19","salary"=>"$6633.02","id"=>"A5130119-A68B-8B19-1DE6-C8B9C0D08DF8"),
	array("name"=>"Ingrid","email"=>"neque.tellus.imperdiet@Duisacarcu.org","birthday"=>"10/02/19","salary"=>"$5485.07","id"=>"4295B05C-B74C-7144-EC8C-8B35F2B1413F"),
	array("name"=>"Isabella","email"=>"dolor@DonectinciduntDonec.com","birthday"=>"23/08/19","salary"=>"$5462.23","id"=>"EF25BA7F-CE9D-3825-54EE-402ECA1CB0BC"),
	array("name"=>"Anjolie","email"=>"tristique.pharetra.Quisque@Nullatincidunt.com","birthday"=>"20/12/18","salary"=>"$1170.75","id"=>"CF5C1F6C-E499-8D06-B468-B632A34B0DF5"),
	array("name"=>"Alexis","email"=>"Pellentesque.habitant@ligulaelit.net","birthday"=>"25/05/19","salary"=>"$7682.71","id"=>"9D9ED458-0E8D-840E-EB6F-745481FF16BE"),
	array("name"=>"Libby","email"=>"libero.at.auctor@sociisnatoque.co.uk","birthday"=>"08/10/18","salary"=>"$8411.76","id"=>"038286D8-DB93-136E-1512-85C7B9175FDE"),
	array("name"=>"Yoko","email"=>"a.odio@MaurisnullaInteger.org","birthday"=>"10/06/18","salary"=>"$6864.55","id"=>"06AB5B06-4D09-66AC-5894-4D1172E5197D"),
	array("name"=>"Karleigh","email"=>"Mauris.quis@aptenttaciti.ca","birthday"=>"26/05/19","salary"=>"$1215.07","id"=>"A3CC660B-F99A-706D-98BC-7B29EBB5BD9D"),
	array("name"=>"Alika","email"=>"Curae@lectusNullam.org","birthday"=>"04/12/19","salary"=>"$8047.31","id"=>"02F4C103-D975-4A3D-D99D-FDE5B5441987"),
	array("name"=>"Buffy","email"=>"pharetra@Maecenas.edu","birthday"=>"04/09/19","salary"=>"$7411.45","id"=>"D4A06B38-4858-DD6A-6717-ED7F5A1738AE"),
	array("name"=>"Sandra","email"=>"nunc.risus.varius@lectus.net","birthday"=>"31/12/18","salary"=>"$2669.12","id"=>"F7659D8A-DD7B-B3B6-392F-8A2549D7713F"),
	array("name"=>"Patricia","email"=>"luctus.et.ultrices@Integereu.com","birthday"=>"12/06/18","salary"=>"$7449.65","id"=>"F9778634-9486-9CB6-2949-D2045F3CB0B8"),
	array("name"=>"Ivana","email"=>"Mauris.ut.quam@utmiDuis.org","birthday"=>"27/11/19","salary"=>"$8746.04","id"=>"2A5C89C2-278D-10D3-92AE-52EC54171E65"),
	array("name"=>"Kelly","email"=>"urna.Nullam@cubiliaCurae.co.uk","birthday"=>"04/02/20","salary"=>"$2459.92","id"=>"1BB4E6FC-8B7F-9DC8-021A-C5BE07D90F46"),
	array("name"=>"Kyla","email"=>"eros@parturientmontesnascetur.ca","birthday"=>"26/09/18","salary"=>"$1154.18","id"=>"C7BA9981-03AA-F6EB-C4B9-3CE94005E614"),
	array("name"=>"Erica","email"=>"risus@iaculisenimsit.edu","birthday"=>"21/09/18","salary"=>"$1205.40","id"=>"27F94806-B849-352E-14F3-B9E642AD8AE4"),
	array("name"=>"Selma","email"=>"ipsum@aliquamenim.ca","birthday"=>"21/09/18","salary"=>"$3128.10","id"=>"0F2D03D4-3C9C-54D5-EC02-C4119F26B783"),
	array("name"=>"Patience","email"=>"neque.tellus@nullaInteger.edu","birthday"=>"12/03/20","salary"=>"$1168.51","id"=>"391DEFAF-F906-58E1-A5C2-37BE18957885"),
	array("name"=>"Kalia","email"=>"Sed.eu@massaIntegervitae.co.uk","birthday"=>"04/01/19","salary"=>"$7119.67","id"=>"3BED7954-4A08-236B-8AF6-C0A0776FF3D3"),
	array("name"=>"Glenna","email"=>"sodales@sagittis.co.uk","birthday"=>"21/12/19","salary"=>"$4233.48","id"=>"6A076A52-1158-699C-6F3B-BD2B17FEADE0"),
	array("name"=>"Stacy","email"=>"fames.ac@egestas.com","birthday"=>"27/06/18","salary"=>"$8205.67","id"=>"E7F4CB28-8E44-796A-95E4-4E8D0FCCC00A"),
	array("name"=>"Iliana","email"=>"purus@Phasellusfermentum.com","birthday"=>"30/01/19","salary"=>"$8389.97","id"=>"C55F3972-8C0E-4AFB-C728-BEACE1C4D63D"),
	array("name"=>"Galena","email"=>"auctor.vitae.aliquet@viverra.co.uk","birthday"=>"28/11/18","salary"=>"$9473.16","id"=>"860F4205-E43B-C1DD-F5FC-0316B71512C2"),
	array("name"=>"Deanna","email"=>"Curabitur.vel.lectus@nonummyFuscefermentum.org","birthday"=>"05/10/19","salary"=>"$7473.99","id"=>"A8F78FFC-4C4A-8883-1619-F7F616155056"),
	array("name"=>"Clio","email"=>"ultricies.ornare.elit@nisinibh.co.uk","birthday"=>"11/04/19","salary"=>"$6410.29","id"=>"DBCD6232-932D-2CA6-06A9-FBAAA62ABA66"),
	array("name"=>"Penelope","email"=>"vehicula.Pellentesque.tincidunt@Cum.net","birthday"=>"30/01/19","salary"=>"$3966.41","id"=>"FD33A376-E8B2-80C3-2167-4B649A4B1654"),
	array("name"=>"Felicia","email"=>"dictum.augue@massa.org","birthday"=>"08/04/19","salary"=>"$8051.17","id"=>"31D13782-ABA8-8D00-EA9A-1CFBDAD4E8C8"),
	array("name"=>"Venus","email"=>"dolor.sit@Sednecmetus.ca","birthday"=>"17/05/20","salary"=>"$9612.14","id"=>"EE42D485-8789-827E-7A22-7FBCD9FBD815"),
	array("name"=>"Mary","email"=>"eget.lacus@aliquetmagnaa.com","birthday"=>"27/01/20","salary"=>"$2160.01","id"=>"1F02E098-4968-79B2-8759-CBF539E01863"),
	array("name"=>"Mallory","email"=>"vel.faucibus@vehicularisus.org","birthday"=>"15/03/19","salary"=>"$9055.74","id"=>"8E54EB4C-FD17-4C17-0771-8FA566D19B3B"),
	array("name"=>"Barbara","email"=>"Sed@pretiumnequeMorbi.edu","birthday"=>"10/10/19","salary"=>"$4751.07","id"=>"61B700BE-B2E5-C4AC-8278-FE582F97F05F"),
	array("name"=>"Sara","email"=>"Cras@imperdiet.edu","birthday"=>"06/01/20","salary"=>"$7343.70","id"=>"76D06EBD-1A3B-EA3B-AEBC-348D0537D7C1"),
	array("name"=>"Julie","email"=>"In@sollicitudinadipiscingligula.net","birthday"=>"30/03/19","salary"=>"$2166.25","id"=>"35E3F221-C7B9-36CC-28D9-3D49A330B0F2"),
	array("name"=>"Astra","email"=>"montes.nascetur@Nulla.com","birthday"=>"28/03/20","salary"=>"$2544.12","id"=>"D7E4F756-0BFD-C432-EAFD-44D4560466AB"),
	array("name"=>"Ariel","email"=>"Mauris.nulla.Integer@nibhQuisque.net","birthday"=>"14/11/18","salary"=>"$7029.81","id"=>"857C6656-CE71-A0B4-9BC3-56E05B8B9901"),
	array("name"=>"Jenna","email"=>"nec@idrisusquis.ca","birthday"=>"28/10/18","salary"=>"$1801.22","id"=>"E57719A7-4395-24DE-1968-A9615B000328"),
	array("name"=>"Adria","email"=>"nec.urna.et@mollis.edu","birthday"=>"06/11/19","salary"=>"$1117.43","id"=>"E038CF88-0B80-EE84-8A8C-136719758294"),
	array("name"=>"Katelyn","email"=>"Maecenas@adipiscingMauris.org","birthday"=>"07/08/18","salary"=>"$4067.79","id"=>"96AC2407-1A69-A16A-5565-CE8953B7674F"),
	array("name"=>"Tasha","email"=>"Curabitur@CuraeDonectincidunt.ca","birthday"=>"13/03/19","salary"=>"$7817.49","id"=>"BCF15FAC-4FB0-90CF-743B-339CBA048C50"),
	array("name"=>"Amy","email"=>"penatibus.et.magnis@Aliquameratvolutpat.com","birthday"=>"19/11/18","salary"=>"$4561.25","id"=>"6F607114-C400-1D0E-9666-A2363DA87352"),
	array("name"=>"Eliana","email"=>"sem@magnased.org","birthday"=>"13/11/18","salary"=>"$3088.77","id"=>"A891E724-FCFC-4F6D-6970-63895B09F720"),
	array("name"=>"Hiroko","email"=>"consectetuer@Pellentesqueut.org","birthday"=>"28/08/19","salary"=>"$7700.45","id"=>"0DCC0226-0C32-66EC-EDD4-052F76F9EBCC"),
	array("name"=>"Eve","email"=>"a.odio.semper@accumsannequeet.com","birthday"=>"22/05/19","salary"=>"$5396.94","id"=>"EC49845B-1F91-EDC4-0016-0938108FDA83"),
	array("name"=>"Colleen","email"=>"mauris.Morbi.non@atpretium.net","birthday"=>"16/01/19","salary"=>"$3636.25","id"=>"349D5CBD-14F3-9972-D369-DAC5FB6B0480"),
	array("name"=>"Dana","email"=>"nisi.Aenean.eget@eratvelpede.org","birthday"=>"09/02/20","salary"=>"$6213.85","id"=>"18213553-5A4D-A2C8-86D0-5E37EC79BFD3"),
	array("name"=>"Yetta","email"=>"ultrices.posuere@erat.org","birthday"=>"01/11/19","salary"=>"$3055.87","id"=>"8C6B2525-7FAE-5385-5A85-F247E11126E7"),
	array("name"=>"Emma","email"=>"vel@pedenonummyut.net","birthday"=>"10/06/18","salary"=>"$8037.25","id"=>"5C9823FB-01CA-ADF2-8FE5-359FD714A20D"),
	array("name"=>"Catherine","email"=>"enim@Aliquamadipiscing.net","birthday"=>"25/07/19","salary"=>"$8961.88","id"=>"FE97BF30-099A-4A3B-0D50-7A44A3BE685A"),
	array("name"=>"Karly","email"=>"enim.condimentum.eget@vel.net","birthday"=>"24/06/18","salary"=>"$3610.45","id"=>"5ECCCDDB-AC40-2215-2E5A-994B7479C347"),
	array("name"=>"Ingrid","email"=>"euismod.urna@ut.edu","birthday"=>"11/06/19","salary"=>"$1860.13","id"=>"6A715D83-D3F6-34EB-3BBB-1975AF41847E"),
	array("name"=>"Grace","email"=>"odio.Etiam.ligula@Sedeueros.ca","birthday"=>"01/09/18","salary"=>"$9424.25","id"=>"4DDD2803-461D-B12E-7337-159AB8A572A7"),
	array("name"=>"Ava","email"=>"at@Donecdignissim.org","birthday"=>"11/04/20","salary"=>"$3332.75","id"=>"606C29EA-6686-C3B8-9B7C-AB91C1A1C6AB"),
	array("name"=>"Kirsten","email"=>"diam@condimentum.co.uk","birthday"=>"03/08/19","salary"=>"$7119.43","id"=>"6D057AAA-C84C-40AC-DC35-0ECAF54F647E"),
	array("name"=>"Jamalia","email"=>"tincidunt.Donec@lacusUt.co.uk","birthday"=>"09/09/19","salary"=>"$6805.38","id"=>"8E6D1A7E-D405-0763-65E1-D17E87EB5E7A"),
	array("name"=>"Amy","email"=>"enim.Curabitur.massa@ac.net","birthday"=>"09/01/20","salary"=>"$6048.91","id"=>"6BBCA3A0-5E96-F9C0-781C-67AD8923AC23"),
	array("name"=>"Calista","email"=>"gravida.sit@Morbi.net","birthday"=>"05/06/20","salary"=>"$1867.11","id"=>"069D1963-A579-968C-F3BA-A455EAFA0151"),
	array("name"=>"Chelsea","email"=>"Cras.eget.nisi@Cras.co.uk","birthday"=>"20/12/18","salary"=>"$4058.72","id"=>"EB550D0F-0D42-FC97-3D70-7EEC4271BF24"),
	array("name"=>"Darryl","email"=>"enim.Sed.nulla@venenatis.com","birthday"=>"23/01/19","salary"=>"$2020.69","id"=>"838DEF80-881F-C940-64F4-CA3D52C9516D"),
	array("name"=>"Quon","email"=>"turpis.Nulla.aliquet@semeget.edu","birthday"=>"04/10/19","salary"=>"$6220.13","id"=>"44301163-A16D-AD63-8EC4-617359B6C2F4"),
	array("name"=>"Oprah","email"=>"Sed.neque.Sed@dolornonummyac.com","birthday"=>"24/09/19","salary"=>"$9044.76","id"=>"158FE197-74DE-79F8-2DFC-34BF380C7029"),
	array("name"=>"Signe","email"=>"libero@nislelementum.co.uk","birthday"=>"08/04/20","salary"=>"$2156.51","id"=>"EC8B8B94-8C2B-54E0-9F40-D0311B2DF33A"),
	array("name"=>"Paloma","email"=>"pellentesque@vitaemauris.com","birthday"=>"30/03/19","salary"=>"$4773.28","id"=>"BB3B43C1-9226-79CE-E2D7-13FC2F6424EC"),
	array("name"=>"Alyssa","email"=>"adipiscing.elit@necmollisvitae.co.uk","birthday"=>"25/11/18","salary"=>"$1415.48","id"=>"16C1F3B8-A196-A204-EDDA-21FC2A67605D"),
	array("name"=>"Brittany","email"=>"posuere.at.velit@risusNuncac.co.uk","birthday"=>"24/06/18","salary"=>"$3176.55","id"=>"920F94EF-B3BD-82B4-BE24-D300D673988D"),
	array("name"=>"Simone","email"=>"sit@vehiculaaliquet.ca","birthday"=>"01/02/19","salary"=>"$2680.97","id"=>"A7E168D1-02E9-4833-B6E5-C64E4780F1D3"),
	array("name"=>"Doris","email"=>"parturient.montes@laoreet.org","birthday"=>"12/11/18","salary"=>"$9328.18","id"=>"BC65D0A9-87B4-BAD6-D153-D45CA97C6093"),
	array("name"=>"Desirae","email"=>"tortor@et.co.uk","birthday"=>"26/02/20","salary"=>"$6276.05","id"=>"39E9EA9F-FBC7-E3C3-3656-7EE79F9CA173"),
	array("name"=>"Amena","email"=>"vel.est@odioNaminterdum.net","birthday"=>"18/10/18","salary"=>"$6454.28","id"=>"9719FFEC-E46B-7385-8E94-03BB710D5000"),
	array("name"=>"Caryn","email"=>"ipsum.nunc.id@ligulaeu.com","birthday"=>"29/01/19","salary"=>"$9535.65","id"=>"4E2165E5-780D-3DCD-F6D4-339214154ED9"),
	array("name"=>"Calista","email"=>"sodales.Mauris.blandit@ac.net","birthday"=>"05/05/20","salary"=>"$3840.77","id"=>"E7A0E244-7A79-860E-C896-1B8366427DB4"),
	array("name"=>"Emerald","email"=>"fringilla.purus.mauris@malesuadavel.org","birthday"=>"05/03/19","salary"=>"$4112.28","id"=>"D030D769-B367-9487-560C-AF6E50D57ABD"),
	array("name"=>"Shea","email"=>"Praesent@lacus.co.uk","birthday"=>"17/10/18","salary"=>"$2936.84","id"=>"BD47C1CA-8C3D-D851-D84D-F1C01C0FB221"),
	array("name"=>"Quemby","email"=>"ipsum.dolor.sit@laoreetposuere.ca","birthday"=>"28/11/18","salary"=>"$3126.12","id"=>"B16A0F5E-D5E5-2870-4CD1-7878DD475780"),
	array("name"=>"Ginger","email"=>"Proin.mi.Aliquam@utnullaCras.ca","birthday"=>"08/04/19","salary"=>"$3157.03","id"=>"2EB9D603-1488-23B7-ED54-798F3ED2385A"),
	array("name"=>"Britanney","email"=>"eget@montesnascetur.net","birthday"=>"10/02/19","salary"=>"$3011.62","id"=>"3DCE5F81-8A2C-2044-EBC1-0D1E052C5D20"),
	array("name"=>"Rana","email"=>"natoque.penatibus.et@arcu.co.uk","birthday"=>"04/05/19","salary"=>"$8985.51","id"=>"58512440-4801-92C1-552D-9B5850784A71"),
	array("name"=>"Farrah","email"=>"dolor.Donec.fringilla@elitCurabitur.org","birthday"=>"29/08/19","salary"=>"$3466.01","id"=>"DD521660-5A21-B7E0-AC66-1A497AB5A1A8")
);


//------------------------------------------Filtering-------------------------------------------

$rowfilterCallback = function($value)
{
    return function(array $item) use ($value)
    {
    	return (substr_count(strtolower(join($item)), strtolower($value) )>0)? true : false;
    };
};

if ( !is_null($input->filter) || strlen($input->filter) > 0 || !empty($input->filter))
{
	$response = array_filter( $response, $rowfilterCallback($input->filter) );
}

//------------------------------------------Sorting---------------------------------------------


$sortFunction = function( $key, $ascending )
{
    return function(array $a, array $b) use ($key,$ascending)
    {
    	if ($a[$key] < $b[$key]) 
	    {
	        return ($ascending)? -1 : 1;
	    }
	    else if ($a[$key] > $b[$key]) 
	    {
	         return ($ascending)? 1 : -1;
	    }
	    else
	    {
	        return 0;
	    }    	
    };
};

if ( is_string($input->order) && is_bool($input->ascending) )
	usort($response, $sortFunction($input->order, $input->ascending));

//------------------------------------------Pagination-------------------------------------------

function countPagesFromArray( $matrixData, int $pageSize )
{
	$counter = 0;

	if ( count($matrixData) > 0 && $pageSize > 0 )
	{
		$counter = intval( count($matrixData)/$pageSize);
		if ( count($matrixData)%$pageSize > 0 || $pageSize > count($matrixData)  ) 
			$counter+=1;
	}
	
	return $counter;
}


function extractPageFromArray( $matrixData, int $pageNumber, int $pageSize )
{
	$result = null;

	$pages = countPagesFromArray($matrixData, $pageSize);

	if ( $pageNumber <= $pages && $pages > 0 )
	{
		$offset = ($pageNumber-1)*$pageSize;
		$diff = 0;
		
		if ( $pageNumber*$pageSize > count($matrixData) )
		{
			$diff = ($pageNumber*$pageSize) - count($matrixData);
		}
		
		$result = array_slice($matrixData, $offset, $pageSize);
	}
	
	return $result;
}

if ( !is_null($input->page) && !is_null($input->pagesize) )
{
	$response = extractPageFromArray($response, intval($input->page), intval($input->pagesize) );
}


//---------------------------------------------JSON Response ---------------------------------------
echo json_encode( $response );

?>
