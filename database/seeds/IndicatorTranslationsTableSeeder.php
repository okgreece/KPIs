<?php

use Illuminate\Database\Seeder;

class IndicatorTranslationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('indicator_translations')->delete();
        
        \DB::table('indicator_translations')->insert(array (
            0 => 
            array (
                'id' => '1',
                'indicator_id' => '1',
                'title' => 'Indicator1',
                'description' => 'Percentage Description',
                'locale' => 'en',
            ),
            1 => 
            array (
                'id' => '2',
                'indicator_id' => '1',
                'title' => 'Τίτλος',
                'description' => 'Περιγραφή',
                'locale' => 'el',
            ),
            2 => 
            array (
                'id' => '3',
                'indicator_id' => '2',
                'title' => 'Title2',
                'description' => 'sample description',
                'locale' => 'en',
            ),
            3 => 
            array (
                'id' => '4',
                'indicator_id' => '2',
                'title' => 'Τίτλος 2',
                'description' => 'Περιγραφή 2',
                'locale' => 'el',
            ),
            4 => 
            array (
                'id' => '5',
                'indicator_id' => '3',
                'title' => 'Employment Cost Index to Expenditure',
                'description' => 'Is the cost of the total salaries of staff in relation to all expenditure. The higher the index, the smaller the possibility of the Municipality investment. Accordingly, the smaller the value of this index, the higher the possibility of the Local PA for making investment, social policy etc.',
                'locale' => 'en',
            ),
            5 => 
            array (
                'id' => '6',
                'indicator_id' => '3',
                'title' => 'Δείκτης Κόστους Απασχόλησης ως προς τις Δαπάνες',
                'description' => 'Εκφράζει το κόστος από τη συνολική μισθοδοσία του προσωπικού σε σχέση με το σύνολο των δαπανών. Όσο μεγαλύτερος είναι ο δείκτης, τόσο περιορίζεται η δυνατότητα του Δήμου για επενδύσεις. Αντίστοιχα, όσο μικρότερη είναι η τιμή αυτού του δείκτη, τόσο αυξάνεται η δυνατότητα του ΟΤΑ για υλοποίηση επενδύσεων, άσκηση κοινωνικής πολιτικής κ.α',
                'locale' => 'el',
            ),
            6 => 
            array (
                'id' => '7',
                'indicator_id' => '4',
                'title' => 'Employment Cost Index to the Costs of Use',
                'description' => 'It expresses the relationship of employment costs of a Local PA to the costs of use. As much as greater the value of the index means that the more they are used resources to cover operating needs, to service employment cost.',
                'locale' => 'en',
            ),
            7 => 
            array (
                'id' => '8',
                'indicator_id' => '4',
                'title' => 'Δείκτης Κόστους Απασχόλησης ως προς τα Έξοδα Χρήσης',
                'description' => 'Εκφράζει τη συσχέτιση του κόστους απασχόλησης ενός Δήμου με τα έξοδα χρήσης του. Όσο μεγαλύτερη είναι η τιμή του δείκτη σημαίνει ότι τόσο περισσότερο χρησιμοποιούνται οι 49 πόροι για την κάλυψη λειτουργικών αναγκών, για την εξυπηρέτηση του κόστους απασχόλησης.',
                'locale' => 'el',
            ),
            8 => 
            array (
                'id' => '9',
                'indicator_id' => '5',
                'title' => 'Total Revenue to Population',
            'description' => 'It expresses the amount corresponding to each citizen (per capita) based on the total of revenue. The higher the index, the more revenue can be allocated to a City per capita for the implementation of its policies.',
                'locale' => 'en',
            ),
            9 => 
            array (
                'id' => '10',
                'indicator_id' => '5',
                'title' => 'Συνολικά Έσοδα προς τον Πληθυσμό',
            'description' => 'Εκφράζει το ποσό που αντιστοιχεί σε κάθε δημότη (κατά κεφαλήν) με βάση το σύνολο των εσόδων. Όσο υψηλότερος είναι ο δείκτης, τόσα περισσότερα έσοδα μπορεί να διαθέσει ο Δήμος ανά κάτοικο για την υλοποίηση των πολιτικών του.',
                'locale' => 'el',
            ),
            10 => 
            array (
                'id' => '11',
                'indicator_id' => '6',
                'title' => 'Expenses per Citizen',
            'description' => 'It expresses the amount corresponding to each citizen (per capita) based on the total of expenses. The higher the index, the more spending per capita has the Municipality for the implementation of the action plan.',
                'locale' => 'en',
            ),
            11 => 
            array (
                'id' => '12',
                'indicator_id' => '6',
                'title' => 'Δείκτης Εξόδων ανά Κάτοικο',
            'description' => 'Εκφράζει το ποσό που αντιστοιχεί σε κάθε δημότη (κατά κεφαλήν) με βάση το σύνολο των εξόδων. Όσο υψηλότερος είναι ο δείκτης, τόσες περισσότερες δαπάνες ανά κάτοικο διαθέτει ο Δήμος για την εφαρμογή του προγράμματος δράσης του.',
                'locale' => 'el',
            ),
            12 => 
            array (
                'id' => '13',
                'indicator_id' => '7',
                'title' => 'Taxation Indicator',
                'description' => 'It expresses the amount charged to each collection of own revenues citizen on average.',
                'locale' => 'en',
            ),
            13 => 
            array (
                'id' => '14',
                'indicator_id' => '7',
                'title' => 'Δείκτης Επιβάρυνσης Δημοτών',
                'description' => 'Εκφράζει το ποσό που επιβαρύνει κάθε δημότη κατά μέσο όρο η είσπραξη των ιδίων εσόδων.',
                'locale' => 'el',
            ),
            14 => 
            array (
                'id' => '15',
                'indicator_id' => '8',
                'title' => 'Retributive Tax Income per Resident',
                'description' => 'It expresses the tax for each citizen from the retributive dues and rights.',
                'locale' => 'en',
            ),
            15 => 
            array (
                'id' => '16',
                'indicator_id' => '8',
                'title' => 'Δείκτης Επιβάρυνσης Ανταποδοτικών Εσόδων ανά Κάτοικο',
                'description' => 'Εκφράζει την επιβάρυνση για κάθε δημότη από τα ανταποδοτικά τέλη και δικαιώματα.',
                'locale' => 'el',
            ),
            16 => 
            array (
                'id' => '17',
                'indicator_id' => '9',
                'title' => 'Taxes and Dues per Resident',
                'description' => 'It expresses the tax for each citizen from taxes and dues.',
                'locale' => 'en',
            ),
            17 => 
            array (
                'id' => '18',
                'indicator_id' => '9',
                'title' => 'Φόροι και Τέλη ανά Κάτοικο',
                'description' => 'Εκφράζει την επιβάρυνση για κάθε δημότη από φόρους και τέλη.',
                'locale' => 'el',
            ),
            18 => 
            array (
                'id' => '19',
                'indicator_id' => '10',
                'title' => 'Operational Costs per Resident',
                'description' => 'The indicator shows the tax of residents for the functional expenses. It expresses that is to say the sum per citizen that is required for the cover of operation of Municipality, benefit of services and application of its policies.',
                'locale' => 'en',
            ),
            19 => 
            array (
                'id' => '20',
                'indicator_id' => '10',
                'title' => 'Έξοδα Χρήσης ανά Κάτοικο',
                'description' => 'Ο δείκτης δείχνει την επιβάρυνση των κατοίκων για τις λειτουργικές δαπάνες. Εκφράζει δηλαδή το ποσό ανά δημότη που απαιτείται για την κάλυψη της λειτουργίας του Δήμου, της παροχής υπηρεσιών και της εφαρμογής των πολιτικών του.',
                'locale' => 'el',
            ),
            20 => 
            array (
                'id' => '21',
                'indicator_id' => '11',
                'title' => 'Investments per Resident',
                'description' => 'It expresses the sum of investments that corresponds in each resident. It expresses that is to say the sum per resident that dedicates the Municipality on average for investments.',
                'locale' => 'en',
            ),
            21 => 
            array (
                'id' => '22',
                'indicator_id' => '11',
                'title' => 'Επενδύσεις ανά Κάτοικο',
                'description' => 'Εκφράζει το ποσό των επενδύσεων που αντιστοιχεί σε κάθε κάτοικο. Εκφράζει δηλαδή το ποσό ανά κάτοικο που αφιερώνει ο Δήμος κατά μέσο όρο για επενδύσεις.',
                'locale' => 'el',
            ),
            22 => 
            array (
                'id' => '23',
                'indicator_id' => '12',
                'title' => 'Subsidies per Resident',
                'description' => 'It expresses the sum that receives the Municipality per resident from the subsidies of central administration.',
                'locale' => 'en',
            ),
            23 => 
            array (
                'id' => '24',
                'indicator_id' => '12',
                'title' => 'Δείκτης Επιχορηγήσεων ανά Κάτοικο',
                'description' => 'Εκφράζει το ποσό που λαμβάνει ο Δήμος ανά κάτοικο από τις επιχορηγήσεις της κεντρικής διοίκησης.',
                'locale' => 'el',
            ),
            24 => 
            array (
                'id' => '25',
                'indicator_id' => '13',
                'title' => 'Subsidies Over Total Expenses',
                'description' => 'It expresses the attendance of subsidies for the cover of expenses of Municipality. As long as bigger it is the price of indicator, so much bigger is the attendance of subsidies in the cover of expenses of Municipality and so much more depended is the Municipality from the subsidies.',
                'locale' => 'en',
            ),
            25 => 
            array (
                'id' => '26',
                'indicator_id' => '13',
                'title' => 'Σύνολο Επιχορηγήσεων προς τα Συνολικά Έξοδα',
                'description' => 'Εκφράζει τη συμμετοχή των επιχορηγήσεων για την κάλυψη των εξόδων του Δήμου. Όσο μεγαλύτερη είναι η τιμή του δείκτη, τόσο μεγαλύτερη είναι η συμμετοχή των επιχορηγήσεων στην κάλυψη των εξόδων του Δήμου και τόσο πιο εξαρτημένος είναι ο Δήμος από τις επιχορηγήσεις.',
                'locale' => 'el',
            ),
            26 => 
            array (
                'id' => '27',
                'indicator_id' => '14',
                'title' => 'Operational Cost over Regular Income',
            'description' => 'It expresses the cover of expenses of use of (functional expenses) from the regular income of Municipality. As long as smaller the price of indicator so much bigger the possibility of cover of expenses of use by the regular income.',
                'locale' => 'en',
            ),
            27 => 
            array (
                'id' => '28',
                'indicator_id' => '14',
                'title' => 'Λειτουργικές Δαπάνες προς τα Τακτικά Έσοδα',
            'description' => 'Εκφράζει την κάλυψη των εξόδων χρήσης (λειτουργικών εξόδων) από τα τακτικά έσοδα του Δήμου. Όσο μικρότερη η τιμή του δείκτη τόσο μεγαλύτερη η δυνατότητα κάλυψης των εξόδων χρήσης από τα τακτικά έσοδα.',
                'locale' => 'el',
            ),
            28 => 
            array (
                'id' => '29',
                'indicator_id' => '15',
                'title' => 'Coverage of Employment Cost',
                'description' => 'As long as higher is the price of indicator, so much more money than the regular income of Municipality is committed for the cover of payroll of personnel, while on the contrary as long as smaller she is the price of indicator so much is increased the possibility of LOCAL AUTHORITY for investments.',
                'locale' => 'en',
            ),
            29 => 
            array (
                'id' => '30',
                'indicator_id' => '15',
                'title' => 'Δείκτης Κάλυψης Κόστους Μισθοδοσίας Προσωπικού',
                'description' => 'Όσο υψηλότερη είναι η τιμή του δείκτη, τόσο περισσότερα χρήματα από τα τακτικά έσοδα του Δήμου δεσμεύονται για την κάλυψη της μισθοδοσίας του προσωπικού, ενώ αντίθετα όσο μικρότερη είναι η τιμή του δείκτη τόσο αυξάνεται η δυνατότητα του ΟΤΑ για επενδύσεις.',
                'locale' => 'el',
            ),
            30 => 
            array (
                'id' => '31',
                'indicator_id' => '16',
                'title' => 'Autonomy',
                'description' => 'It in its entirety expresses the rate of attendance of regular income of income of Municipality. As long as bigger it is the price of indicator so much bigger is the self-reliance of Municipality while is supported in regular income. The regular income is foreseeable sources of income and thus the Municipality can make much better planning.',
                'locale' => 'en',
            ),
            31 => 
            array (
                'id' => '32',
                'indicator_id' => '16',
                'title' => 'Αυτονομία',
                'description' => 'Εκφράζει το ποσοστό συμμετοχής των τακτικών εσόδων στο σύνολο των εσόδων του Δήμου. Όσο μεγαλύτερη είναι η τιμή του δείκτη τόσο μεγαλύτερη είναι η αυτοδυναμία του Δήμου καθώς στηρίζεται σε τακτικά έσοδα. Τα τακτικά έσοδα είναι προβλέψιμες πηγές εσόδων και έτσι ο Δήμος μπορεί να κάνει πολύ καλύτερο προγραμματισμό.',
                'locale' => 'el',
            ),
            32 => 
            array (
                'id' => '33',
                'indicator_id' => '17',
                'title' => 'Instability',
                'description' => 'It in its entirety expresses the rate of attendance of extraordinary income of income of Municipality. As long as bigger it is the price of this indicator so much more depends the LOCAL AUTHORITY from not checked sources of income in annual base. Consequently exists small possibility of autonomous planning and action',
                'locale' => 'en',
            ),
            33 => 
            array (
                'id' => '34',
                'indicator_id' => '17',
                'title' => 'Αστάθεια',
                'description' => 'Εκφράζει το ποσοστό συμμετοχής των εκτάκτων εσόδων στο σύνολο των εσόδων του Δήμου. Όσο μεγαλύτερη είναι η τιμή αυτού του δείκτη τόσο περισσότερο εξαρτάται ο ΟΤΑ από μη ελεγχόμενες πηγές εσόδων σε ετήσια βάση. Συνεπώς υπάρχει μικρή δυνατότητα αυτόνομου προγραμματισμού και δράσης',
                'locale' => 'el',
            ),
            34 => 
            array (
                'id' => '35',
                'indicator_id' => '18',
                'title' => 'Dependence',
            'description' => 'It expresses the rate of attendance of subsidies (regular and extraordinary) the Municipality of in its entirety his income. As long as it increases the price of indicator, so much more is limited the self-reliance of Municipality and increases his dependence from subsidies. A small price of this indicator can show weakness of Municipality for planning, planning and absorption of subsidies.',
                'locale' => 'en',
            ),
            35 => 
            array (
                'id' => '36',
                'indicator_id' => '18',
                'title' => 'Εξάρτηση',
            'description' => 'Εκφράζει το ποσοστό συμμετοχής των επιχορηγήσεων (τακτικών και εκτάκτων) του Δήμου στο σύνολο των εσόδων του. Όσο αυξάνει η τιμή του δείκτη, τόσο περισσότερο περιορίζεται η αυτοδυναμία του Δήμου και αυξάνει η εξάρτησή του από επιχορηγήσεις. Μια μικρή τιμή αυτού του δείκτη μπορεί να δείχνει αδυναμία του Δήμου για προγραμματισμό, σχεδιασμό και απορρόφηση επιχορηγήσεων.',
                'locale' => 'el',
            ),
            36 => 
            array (
                'id' => '37',
                'indicator_id' => '19',
                'title' => 'Independence',
            'description' => 'It in its entirety expresses the rate of attendance of same income of Municipality of income. As long as it increases this indicator, so much smaller is the dependence of LOCAL AUTHORITY from the regular and extraordinary subsidies and from other income (pch. Loans) and thus has the possibility of making a effective economic planning.',
                'locale' => 'en',
            ),
            37 => 
            array (
                'id' => '38',
                'indicator_id' => '19',
                'title' => 'Ανεξαρτησία',
            'description' => 'Εκφράζει το ποσοστό συμμετοχής των ιδίων εσόδων του Δήμου στο σύνολο των εσόδων. Όσο αυξάνει αυτός ο δείκτης, τόσο μικρότερη είναι η εξάρτηση του ΟΤΑ από τις τακτικές και έκτακτες επιχορηγήσεις και από άλλα έσοδα (πχ. Δάνεια) και έτσι έχει την δυνατότητα να κάνει έναν αποτελεσματικό οικονομικό προγραμματισμό.',
                'locale' => 'el',
            ),
            38 => 
            array (
                'id' => '39',
                'indicator_id' => '20',
                'title' => 'Operational Autonomy',
                'description' => 'It is the relation that shows the rate of attendance of same regular income of in its entirety regular income. As long as it is increased the price of indicator so much is increased the independence of Municipality from the financing of Central Administration and thus it can program his economic obligations with base local sources of income.',
                'locale' => 'en',
            ),
            39 => 
            array (
                'id' => '40',
                'indicator_id' => '20',
                'title' => 'Λειτουργική Αυτονομία',
                'description' => 'Είναι η σχέση που δείχνει το ποσοστό συμμετοχής των ιδίων τακτικών εσόδων στο σύνολο των τακτικών εσόδων. Όσο αυξάνεται η τιμή του δείκτη τόσο αυξάνεται η ανεξαρτησία του Δήμου από τις χρηματοδοτήσεις της Κεντρικής Διοίκησης και έτσι μπορεί να προγραμματίζει τις οικονομικές του υποχρεώσεις με βάση τοπικές πηγές εσόδων.',
                'locale' => 'el',
            ),
            40 => 
            array (
                'id' => '41',
                'indicator_id' => '21',
                'title' => 'Operational Expenses',
                'description' => 'It expresses the percentage of total expenses constitute the functional expenses of Municipality. High prices of indicator, reveal that the bigger part of expenses has been disposed for operation and thus haven\'t become a lot of investments. It can also mean particularly high functional cost and hence wastefulness of resources, something that will result from examination of other indicators.',
                'locale' => 'en',
            ),
            41 => 
            array (
                'id' => '42',
                'indicator_id' => '21',
                'title' => 'Λειτουργικές Δαπάνες',
            'description' => 'Εκφράζει τι ποσοστό των συνολικών εξόδων αποτελούν οι λειτουργικές δαπάνες του Δήμου. Υψηλές τιμές του δείκτη, φανερώνουν ότι το μεγαλύτερο μέρος των εξόδων έχει διατεθεί για έξοδα χρήσης και έτσι δεν έχουν γίνει πολλές επενδύσεις (έργα, αγορές παγίων κτλ.). Μπορεί επίσης να σημαίνει ιδιαίτερα υψηλό λειτουργικό κόστος και άρα σπατάλη πόρων, κάτι όμως που θα προκύψει από εξέταση και άλλων δεικτών.',
                'locale' => 'el',
            ),
            42 => 
            array (
                'id' => '43',
                'indicator_id' => '22',
                'title' => 'Investments',
                'description' => 'It expresses which percentage of total expenses it has been allocated in work and investments. High prices show the will for investment choices. Also it can they imply that it is found in stage of rapid growth, where needs for pch the creation of infrastructures. From the other, the high prices can be owed or in drastically limited functional expenses, or in non-existence of benefit of services.',
                'locale' => 'en',
            ),
            43 => 
            array (
                'id' => '44',
                'indicator_id' => '22',
                'title' => 'Επενδύσεις',
                'description' => 'Εκφράζει τι ποσοστό των συνολικών εξόδων έχει διατεθεί σε έργα και επενδύσεις. Υψηλές τιμές δείχνουν την βούληση για επενδυτικές επιλογές. Επίσης μπορεί να υποδηλώνουν πως βρίσκεται σε στάδιο ταχείας ανάπτυξης, όπου χρειάζεται για πχ η δημιουργία υποδομών. Από την άλλη, οι υψηλές τιμές μπορεί να οφείλονται είτε σε δραστικά περιορισμένα λειτουργικά έξοδα, είτε σε ανυπαρξία παροχής υπηρεσιών.',
                'locale' => 'el',
            ),
            44 => 
            array (
                'id' => '45',
                'indicator_id' => '23',
                'title' => 'Obligations',
                'description' => 'It expresses the percentage of CHEP that has not been paid off as for the total of paid expenses. As long as it increases this indicator, so much bigger are the obligations of Municipality to third person.',
                'locale' => 'en',
            ),
            45 => 
            array (
                'id' => '46',
                'indicator_id' => '23',
                'title' => 'Υποχρεώσεις',
                'description' => 'Εκφράζει το ποσοστό των ΧΕΠ που δεν έχουν εξοφληθεί ως προς το σύνολο των πληρωθέντων εξόδων. Όσο αυξάνει αυτός ο δείκτης, τόσο μεγαλύτερες είναι οι υποχρεώσεις του Δήμου προς τρίτους.',
                'locale' => 'el',
            ),
            46 => 
            array (
                'id' => '47',
                'indicator_id' => '24',
                'title' => 'Recievable',
                'description' => 'It expresses the proportion of uncollected revenue in total revenue collected. The higher this ratio the greater the requirements the Municipality by third parties.',
                'locale' => 'en',
            ),
            47 => 
            array (
                'id' => '48',
                'indicator_id' => '24',
                'title' => 'Απαιτήσεις',
                'description' => 'Εκφράζει το ποσοστό των ανείσπρακτων εσόδων ως προς το σύνολο των εισπραχθέντων εσόδων. Όσο μεγαλύτερος αυτός ο δείκτης τόσο αυξάνονται οι απαιτήσεις του Δήμου από τρίτους.',
                'locale' => 'el',
            ),
            48 => 
            array (
                'id' => '49',
                'indicator_id' => '25',
                'title' => 'Settlement of Lending Obligations',
            'description' => 'It shows the percentage of regular income that is intended for the cover of tokochreolytikon doses. Tokochreolysia they emanate from loans that has raised the LOCAL AUTHORITY with credit institutions of interior (mainly from the Fund of Deposits and Loans) or abroad, so that it covers functional and investment expenses.',
                'locale' => 'en',
            ),
            49 => 
            array (
                'id' => '50',
                'indicator_id' => '25',
                'title' => 'Αποπληρωμή Δανειακών Υποχρεώσεων',
            'description' => 'Δείχνει το ποσοστό των τακτικών εσόδων που προορίζεται για την κάλυψη των τοκοχρεολυτικών δόσεων. Τα τοκοχρεολύσια προέρχονται από δάνεια που έχει συνάψει ο ΟΤΑ με πιστωτικά ιδρύματα του εσωτερικού (κυρίως από το Ταμείο Παρακαταθηκών και Δανείων) ή του εξωτερικού, προκειμένου να καλύψει λειτουργικές και επενδυτικές δαπάνες.',
                'locale' => 'el',
            ),
        ));
        
        
    }
}