<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,500" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/stringMonthYear.js"></script>

</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Zebra striping */

    tr:nth-of-type(odd) {
        background: #f4f4f4;
    }

    tr:nth-of-type(even) {
        background: #fff;
    }

    th {
        background: #782f40;
        color: #ffffff;
        font-weight: 300;
    }

    td,
    th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
    }

    td:nth-of-type(1) {
        font-weight: 500 !important;
    }

    td {
        font-family: 'Roboto', sans-serif !important;
        font-weight: 300;
        line-height: 20px;
    }

    span {
        font-style: italic
    }

    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        /* Force table to not be like tables anymore */
        table.responsive,
        .responsive thead,
        .responsive tbody,
        .responsive th,
        .responsive td,
        .responsive tr {
            display: block !important;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        .responsive thead tr {
            position: absolute !important;
            top: -9999px;
            left: -9999px;
        }

        .responsive tr {
            border: 1px solid #ccc;
        }

        .responsive td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee !important;
            position: relative !important;
            padding-left: 25% !important;
        }

        .responsive td:before {
            /* Now like a table header */
            position: absolute !important;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap !important;
            font-weight: 500 !important;
        }

        /*
          Label the data
          */
        .responsive td:before {
            content: attr(data-table-header) !important;
        }
    }
</style>


<script>
    $(document).ready(function () {
        $("#sort").DataTable({
            columnDefs: [
                {type: 'date', targets: [3]}
            ],
        });
    });
</script>

<body>

<div class="row">
    <div class="container">

        <h1>Bootstrap 3 SortTable</h1>
        <table class="table responsive" id="sort">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Authors</th>
                <th scope="col">Journal</th>
                <th scope="col">Date</th>
                <th scope="col">Link</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-table-header="Title">Parent Adolescent Relationship Factors and Adolescent Outcomes Among
                    High-Risk Families.
                </td>
                <td data-table-header="Authors">Matthew Withers, Lenore McWey, Mallory Lucier-Greer</td>
                <td data-table-header="Journal">Family Relations</td>
                <td data-table-header="Date">Jan. 2017</td>
                <td data-table-header="Link"><a
                            href="http://onlinelibrary.wiley.com/doi/10.1111/fare.12220/abstract;jsessionid=D46252981BC2D32EB8FF085F9B1E7071.f02t01"
                            target="_blank" title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                   class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Prescription Drugs and Nutrient Depletion: How Much is Known?</td>
                <td data-table-header="Authors">Wendimere Reilly, Jasminka Ilich</td>
                <td data-table-header="Journal">Advances in Nutrition: An International Review Journal</td>
                <td data-table-header="Date">Jan. 2017</td>
                <td data-table-header="Link"><a href="http://advances.nutrition.org/content/8/1/23.short"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Relation of Adiponectin with Body Adiposity and Bone Mineral Density in
                    Older Women.
                </td>
                <td data-table-header="Authors">Pegah Jafari Nasabian, Julia Inglis, Miranda Ave, Hayley Hebrock, Katie
                    Hall, Sara Nieto, Jasminka Ilich
                </td>
                <td data-table-header="Journal">Advances in Nutrition: An International Review Journal</td>
                <td data-table-header="Date">Jan. 2017</td>
                <td data-table-header="Link"><a href="http://advances.nutrition.org/content/8/1/11.short"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Benefits of whole-body vibration training on arterial function and muscle
                    strength in young overweight/obese women.
                </td>
                <td data-table-header="Authors">Alvarez-Alvarado S, Jaime SJ, Ormsbee MJ, Campbell JC, Post J, Pacilio
                    J, Figueroa A.
                </td>
                <td data-table-header="Journal">Hypertension Research International Journal</td>
                <td data-table-header="Date">Jan. 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/28077859" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Overexpression of PGC-1α Increases Peroxisomal and Mitochondrial Fatty
                    Acid Oxidation in Human Primary Myotubes.
                </td>
                <td data-table-header="Authors">Huang TY, Zheng D, Houmard JA, Brault JJ, Hickner RC, Cortright RN.</td>
                <td data-table-header="Journal">American Journal of Physiology: Endocrinology and Metabolism</td>
                <td data-table-header="Date">Jan. 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/28073778" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Observed Parenting in Families exposed to Homelessness: Child and Parent
                    Characteristics as Predictors of Response to the Early Risers Intervention.
                </td>
                <td data-table-header="Authors">Kendal Holtrop, Timothy F. Piehler, Abigail H. Gewirtz, Gerald J.
                    August
                </td>
                <td data-table-header="Journal">Child and Family Well-Beging and Homelessness:&nbsp;Integrating&nbsp;Research
                    into Practice and Policy
                </td>
                <td data-table-header="Date">Feb. 2017</td>
                <td data-table-header="Link"><a href="https://link.springer.com/chapter/10.1007/978-3-319-50886-3_3"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Testing the impact of sliding versus deciding in cyclical and non cyclical
                    relationships.
                </td>
                <td data-table-header="Authors">Charity E. Clifford, Amber Vennum, Michelle Busk, Frank D. Fincham</td>
                <td data-table-header="Journal">Personal Relationships:&nbsp;Journal of the International Assoc. for
                    Relationship Research
                </td>
                <td data-table-header="Date">Feb. 2017</td>
                <td data-table-header="Link"><a href="http://onlinelibrary.wiley.com/doi/10.1111/pere.12179/full"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Personal and Cultural Identity Development in Recently Immigrated Hispanic
                    Adolescents: Links With Psychosocial Functioning.
                </td>
                <td data-table-header="Authors">Meca A, Sabet RF, Farrelly CM, Benitez CG, Schwartz SJ,&nbsp;Gonzales-Backen
                    M, Lorenzo-Blanco EI, Unger JB, Zamboanga BL, Baezconde-Garbanati L, Picariello S, Des Rosiers SE,
                    Soto DW, Pattarroyo M, Villamar JA, Lizzi KM. 
                </td>
                <td data-table-header="Journal">American Psychological Association: Cultural Diversity &amp; Ethnic
                    Minority Psychology
                </td>
                <td data-table-header="Date">Feb. 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/28206778" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">School burnout and intimate partner violence: The role of self-control.
                </td>
                <td data-table-header="Authors">AN Cooper, GS Seibert, RW May, MC Fitzgerald, FD Fincham</td>
                <td data-table-header="Journal">Personality and Individual Differences</td>
                <td data-table-header="Date">Feb. 2017</td>
                <td data-table-header="Link"><a
                            href="http://www.sciencedirect.com/science/article/pii/S0191886917301265" target="_blank"
                            title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                   class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Efficacy Of The Repetitions In Reserve-Based Rating Of Perceived Exertion
                    For The Bench Press In Experienced And Novice Benchers.
                </td>
                <td data-table-header="Authors">Ormsbee MJ, Carzoli JP, Klemp A, Allman BR, Zourdos MC, Kim JS, Panton
                    LB.
                </td>
                <td data-table-header="Journal">The Journal of Strength and Conditioning Research</td>
                <td data-table-header="Date">March 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/28301439" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Exercise training reverses age-induced diastolic dysfunction and restores
                    coronary microvascular function.
                </td>
                <td data-table-header="Authors">Hotta K, Chen B, Behnke BJ, Ghosh P, Stabley JN, Bramy JA, Sepulveda JL,
                    Delp MD, Muller-Delp JM.
                </td>
                <td data-table-header="Journal">The Journal of Physiology</td>
                <td data-table-header="Date">March 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/28295341" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Macronutrient Intake and Distribution in the Etiology, Prevention and
                    Treatment of Osteosarcopenic Obesity.
                </td>
                <td data-table-header="Authors">Kelly OJ, Gilman JC, Kim Y, Ilich JZ.</td>
                <td data-table-header="Journal">Current Aging Science</td>
                <td data-table-header="Date">May 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/27156951" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Perception in Romantic Relationships: a Latent Profile Analysis of Trait
                    Mindfulness in Relation to Attachment and Attributions.
                </td>
                <td data-table-header="Authors">JG Kimmes, JA Durtschi, FD Fincham.</td>
                <td data-table-header="Journal">Mindfulness</td>
                <td data-table-header="Date">April 2017</td>
                <td data-table-header="Link"><a href="https://link.springer.com/article/10.1007/s12671-017-0708-z"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Individual Differences in Adolescents’ Emotional Reactivity across
                    Relationship Contexts.
                </td>
                <td data-table-header="Authors">Cook EC, Blair BL, Buehler C.</td>
                <td data-table-header="Journal">Journal of Youth Adolescence</td>
                <td data-table-header="Date">April 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/28432534" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Is Plus Size Equal? The Positive Impacts of Average and Plus Sized Media
                    Fashion Models on Women’s Cognitive Resource Allocation, Social Comparisons, and Body Satisfaction.
                    [in press]
                </td>
                <td data-table-header="Authors">RB Clayton, JL Ridgway, J Hendrickse.</td>
                <td data-table-header="Journal">Communication Monographs</td>
                <td data-table-header="Date">April 2017</td>
                <td data-table-header="Link">&nbsp;</td>
            </tr>
            <tr>
                <td data-table-header="Title">Effects of Tart Cherry Juice on Brachial and Aortic Hemodynamics, Arterial
                    Stiffness, and Blood Biomarkers of Cardiovascular Health in Adults with Metabolic Syndrome.
                </td>
                <td data-table-header="Authors">Sarah Johnson, Negin Navaei, Shirin Pourafshar, Salvador Jaime, Neda
                    Akhavan, Stacey Alvarez-Alvarado, Nicole Litwin, Marcus Elam, Mark Payton, Bahram Arjmandi, Arturo
                    Figueroa.
                </td>
                <td data-table-header="Journal">Journal of Federation of American Societies for Experimental Biology
                </td>
                <td data-table-header="Date">April 2017</td>
                <td data-table-header="Link"><a href="http://www.fasebj.org/content/31/1_Supplement/lb325.short"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Parenting Styles and College Enrollment: A Path Analysis of Risky Human
                    Capital Decisions.
                </td>
                <td data-table-header="Authors">J Kimmes, S Heckman</td>
                <td data-table-header="Journal">Journal of Family and Economic Issues</td>
                <td data-table-header="Date">May 2017</td>
                <td data-table-header="Link"><a href="https://link.springer.com/article/10.1007/s10834-017-9529-4"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Emerging Adult Relationship Transitions as Opportune Times for Tailored
                    Interventions.
                </td>
                <td data-table-header="Authors">A Vennum, JK Monk, BK Pasley, FD Fincham</td>
                <td data-table-header="Journal">Emerging Adulthood</td>
                <td data-table-header="Date">May 2017</td>
                <td data-table-header="Link"><a
                            href="https://www.researchgate.net/publication/316752576_Emerging_Adult_Relationship_Transitions_as_Opportune_Times_for_Tailored_Interventions"
                            target="_blank" title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                   class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Watermelon and L-Arginine Consumption Regulate Gene Expression Related to
                    Serum Lipid Profile, Inflammation, and Oxidative Stress in Rats Fed on Atherogenic Diet.
                </td>
                <td data-table-header="Authors">Joshua Beidler, Shirin Hooshmand, Mark Kern, Arturo Figueroa, Men Young
                    Hong
                </td>
                <td data-table-header="Journal">Journal of Federation of American Societies for Experimental Biology
                </td>
                <td data-table-header="Date">April 2017</td>
                <td data-table-header="Link"><a href="http://www.fasebj.org/content/31/1_Supplement/431.2"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Contribution of Adiponectin to Vascular Responses in Bone Resistance
                    Arteries in Mice.
                </td>
                <td data-table-header="Authors">Payal Ghosh, Kazuki Hotta, Tiffany Lucero, Kyle Borodunovich, Morgan
                    Cowan, Jeremy Bramy, Bradley Behnke, Michael Delp, Judy Delp
                </td>
                <td data-table-header="Journal">Journal of Federation of American Societies for Experimental Biology
                </td>
                <td data-table-header="Date">April 2017</td>
                <td data-table-header="Link"><a href="http://www.fasebj.org/content/31/1_Supplement/684.16.short"
                                                target="_blank" title="FSU Human Sciences Research"><i
                                aria-hidden="true" class="fa fa-external-link">&nbsp;</i></a></td>
            </tr>
            <tr>
                <td data-table-header="Title">Bone-Protective Effects of Dried Plum in Postmenopausal Women: Efficacy
                    and Possible Mechanisms.
                </td>
                <td data-table-header="Authors">Arjmani BH, Johnson SA, Pourafshar S, Navaei N, George KS, Hooshmand S,
                    Chai SC, Akhavan NS
                </td>
                <td data-table-header="Journal">Nutrients</td>
                <td data-table-header="Date">May 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/28505102" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            <tr>
                <td data-table-header="Title">Cardiovascular Responses to Unilateral, Bilateral, and Alternating Limb
                    Resistance Exercise Performed Using Different Body Sements.
                </td>
                <td data-table-header="Authors">Moreira OC, Faraci LL, de Matos DG, Mazini Filho ML, da Silva SF, Aidar
                    FJ, Hickner RC, de Oliveira CE
                </td>
                <td data-table-header="Journal">Journal of Strength and Conditioning Research</td>
                <td data-table-header="Date">March 2017</td>
                <td data-table-header="Link"><a href="https://www.ncbi.nlm.nih.gov/pubmed/26382128" target="_blank"
                                                title="FSU Human Sciences Research"><i aria-hidden="true"
                                                                                       class="fa fa-external-link">&nbsp;</i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


</body>
</html>