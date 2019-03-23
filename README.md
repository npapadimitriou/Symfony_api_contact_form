# Symfony_api_contact_form
Contact form created in symfony using api 


In order to see the Http Get , start server and hit ../api/departments
For the HTTP post I used Mozilla extensio RESTED Clietnt  hitting the adress http://127.0.0.1:8000/api/user
 using JSON and variable Names

Name 
Surname 
EmailAddress 
Message
Department(id)

For this project bundles that where used
   Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\WebServerBundle\WebServerBundle::class => ['dev' => true],
    FOS\RestBundle\FOSRestBundle::class => ['all' => true],
    JMS\SerializerBundle\JMSSerializerBundle::class => ['all' => true],
    Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class => ['all' => true],
    Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle::class => ['dev' => true, 'test' => true],
    Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    Symfony\Bundle\DebugBundle\DebugBundle::class => ['dev' => true, 'test' => true],
];

By using these I created
src/Controller/FirstContreoller.php containnin all our controllers
src/DataFixtures/AppFixtures.php to give initials values to our departments
src/Entity/DepartmentEmail.php keeping properties of Departments 
src/Entity/Usercredentials.php keeping properties of Users
src/Form/ContactType.php for creating our form
src/Repository/DepartmentEmailRepository.php created automatically with the entity Departmentemail BUT inside there is 
a Querybuilder function for fetching DepartmentName and id from our Departmentemail table

src/Repository/UsercredentialsRepository.php autocreated while making the entity  create:entity



src/Controller/Firstcontroller.php
getDepartment()-> HTTP get method that calls the functions of the DepartmentEmailRepository and returns the result
postNewUser(Request $request, \Swift_Mailer $mailer) ->HTTP post method there is where we create the form and if it is well created it gets into the database and sends an email 
t the admin

function sendemail($contactFormData,$mailer)-> sends the email.


