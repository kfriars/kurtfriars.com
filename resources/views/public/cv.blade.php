@extends('public')

@section('content')
    <div class="sm:mt-8 mx-auto w-screen-responsive grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4">
        <div class="col-span-2 xl:col-span-3 p-4">
            <div class="mb-12">
                <h2 class="sm:hidden text-responsive my-4 font-semibold">Curriculum Vitae</h2>
                <h3 class="hidden sm:block text-responsive mb-2 font-semibold">Summary</h3>
                
                <p class="mb-4">I have 5+ years of experience in professional web development up and down the stack. I also have a wealth of experience working in remote teams, fostering productive and engaging work relationships and environments.</p>
                
                <p>I am seeking an opportunity to collaborate and employ my expertise in Laravel, Vue, modern CSS, Test Automation and CI/CD in order to deliver high-quality software to satisfied users and clients.</p>
            </div>
            <div class="mb-12">
                <h3 class="text-responsive mb-2 font-semibold">Experience</h3>
                <x-experience
                    logo="{{ asset('images/resume/flowcates-logo.png') }}"
                    job-title="Co-Founder"
                    company="Flowcates"
                    start="Jun 2020"
                    end="Now"
                >
                    <p class="mb-4">As a self-motivated and driven problem solver who has learned the real-world lessons of web application development by getting my hands dirty, I have applied my skills to solving a problem I discovered during my time working in the construction industry.</p>

                    <p class="mb-4">As the technical Co-Founder at Flowcates, I am responsible for planning, designing and building all aspects of the technology stack. As the technical lead at Flowcates, my duties have been all-encompassing.</p>

                    <ul class="ml-8 list-disc">
                        <li>organize and plan development work</li>
                        <li>author and plan test suites in PHPUnit and Cypress.io to achieve > 90% code coverage</li>
                        <li>create the user facing application using Laravel, VueJS and Tailwind Css</li>
                        <li>implement the admin facing site using Laravel Nova</li>
                        <li>create an automated email parsing system using Mailgun, Imagick and Google Vision API that reduces the time required to triage emails by 80%</li> 
                        <li>configure zero downtime CI/CD pipeline using Laravel Forge and Envoyer</li>
                        <li>work with clients and other stakeholders to ensure that efforts are being directed  appropriately to meet the needs of clients</li>
                    </ul>
                </x-experience>
                <x-experience
                    logo="{{ asset('images/resume/wsh-logo.png') }}"
                    job-title="Lead Software Engineer"
                    company="Apex Workstation Health Inc."
                    start="Oct 2018"
                    end="Jun 2020"
                >
                    <p class="mb-4">As Apex Occupational Health Solutions Inc. gained traction with version one of it’s platform, the company formed strategic partnerships with Staples Business Advantage and The Canadian Back Institute to deliver its services to enterprise-level clients across Canada.</p>
                    
                    <p class="mb-4">A new company was formed and I became responsible for leading a development team to deliver a new version of the application. Working alongside the Project Manager, a QA Automation Specialist, and Front-End and Back-End Developers, the team was distributed across the globe, working entirely remotely to create the new version of the platform.</p>
                    
                    <p class="mb-4">I worked closely with the Project Manager and key stakeholders to organize and plan development efforts using agile methodologies. With years of experience working remotely, I have learned to communicate efficiently and effectively to drive a team towards its goals.</p>

                    <ul class="ml-8 list-disc">
                        <li>created user stories and other documentation to translate the needs of the business into development work</li>
                        <li>worked with the PM in sprint planning, grooming the backlog, and leading stand-ups</li>
                        <li>implemented comprehensive automated test suites for Unit Testing, Feature Testing, and End-to-End Browser Testing</li>
                        <li>assisted in configuring and managing our Docker and Jenkins based CI/CD pipeline</li>
                    </ul>
                </x-experience>
                <x-experience
                    logo="{{ asset('images/resume/apex-logo.png') }}"
                    job-title="Web Developer"
                    company="Apex Occupational Health Solutions Inc."
                    start="Jan 2015"
                    end="Oct 2018"
                >
                    <p class="mb-4">Apex identified a need for an interactive tool to help their clients manage their ergonomics through an online learning and diagnostic tool. As the sole developer working on the project, I was responsible for architecting and implementing every aspect of the system.</p>

                    <p class="mb-4">As a brand new Web Developer, I employed my problem-solving skills and the theoretical knowledge I acquired during University to cut my teeth on a real-world web application.</p>

                    <ul class="ml-8 list-disc">
                        <li>learned web security considerations</li>
                        <li>implemented the backend of the system using PHP and Drupal</li>
                        <li>gained confidence writing efficient and well-structured SQL Queries</li>
                        <li>implemented the Front-End using Javascript and jQuery</li>
                        <li>advanced my skills at writing well-structured HTML and CSS</li>
                        <li>learned basic server administration and Apache configuration</li>
                    </ul>
                </x-experience>
                <x-experience
                    logo="{{ asset('images/resume/ecpower-logo.jpeg') }}"
                    job-title="General Labourer"
                    company="EC Power & Lighting Ltd."
                    start="Sept 2012"
                    end="Jan 2015"
                >
                    <p class="mb-4">After years of theoretical learning during my university years, and finding myself somewhat disillusioned working for a massive corporation, I took some time away from software development to work in construction.</p>
                    
                    <p class="mb-4">As a university-educated labourer, I was given many opportunities for growth inside of the company and learned many aspects of electrical road construction, both in the field and in the office. It was during this time that I became aware of the need for my current business venture, Flowcates.</p>

                    <ul class="ml-8 list-disc">
                        <li>learned to read traffic and street lighting schematics</li>
                        <li>drove large trucks, trailers and forklifts</li>
                        <li>efficiently managed Locates for many dig sites</li>
                        <li>gained a true appreciation for the difficult and dangerous nature of electrical construction</li>
                        <li>responsible for keeping the shop organized</li>
                        <li>ensured crews had all traffic signals and street lighting ready for installation in the field</li>
                    </ul>
                </x-experience>
                <x-experience
                    logo="{{ asset('images/resume/bb-logo.png') }}"
                    job-title="Software Test Associate"
                    company="BlackBerry"
                    start="May 2008"
                    end="Sept 2011"
                >
                    <p class="mb-4">For four summers during my university career, I worked in the Software Verification and Validation Department of the mobile handset giant, BlackBerry. During my tenure there, I gained a wealth of knowledge in the field of software testing.</p>

                    <p class="mb-4">As a Software Testing Associate, daily activities included executing time-sensitive test cases to ensure the quality of development and release builds, verifying bug fixes, and investigating issues to determine cause and reproducibility. This provided an excellent foundation in the effective management and resolution of defects throughout the logging, triaging, investigation, and verification processes.</p>
                    
                    <p class="mb-4">As the summers progressed, so did my role. New responsibilities included test case design, test planning, and some configuration and monitoring of automated tests. In the final summer, I worked closely with developers as a lead tester for a new core application under development.</p>

                    <ul class="ml-8 list-disc">
                        <li>created minimal reproducible examples for defects, as well as detailed bug reports</li>
                        <li>designed manual test cases to expand coverage of new features</li>
                        <li>planned the execution of tests to have the right coverage for the right builds</li>
                        <li>developed an online / email-based survey tool to determine the presence of known defects and the frequency of intermittent issues</li>
                    </ul>
                </x-experience>
            </div>
        </div>
        <div class="col-span-1 p-4">
            <div class="mb-8 hidden lg:block">
                <h6 class="text-responsive font-semibold">Hire Me!</h6>
                <p class="text-base mb-2">I am actively seeking engaging opportunities.</p>
                <button @click="events.publish('show-hire-me-modal')" class="btn bg-orange-500 text-white font-semibold -ml-1">
                    Let's Talk
                </button>
            </div>
            <div class="mb-8 -mt-12 lg:mt-0">
                <h6 class="text-responsive font-semibold mb-2 lg:mb-4">Education</h6>
                <div class="flex justify-start">
                    <img class="w-16 object-contain" src="{{ asset('images/resume/mcmaster.png') }}">
                    <div class="pl-4">
                        <p class="text-base">Bachelor of Engineering</p>
                        <p class="text-xs">Software Engineering</p>
                        <p class="text-xs">McMaster University</p>
                        <p class="text-xs">2007 - 2012</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 col-gap-0 md:grid-cols-2 md:col-gap-12 lg:grid-cols-1 lg:col-gap-0">
                <div class="mb-6">
                    <h6 class="text-responsive font-semibold mb-1">Back End</h6>
                    <div class="flex flex-col justify-start items-stretch">
                        <x-proficiency label="PHP" pct="80"/>
                        <x-proficiency label="Laravel" pct="90"/>
                        <x-proficiency label="Nova" pct="65"/>
                        <x-proficiency label="MySQL" pct="70"/>
                    </div>
                </div>
                <div class="mb-6">
                    <h6 class="text-responsive font-semibold mb-1">Test Automation</h6>
                    <div class="flex flex-col justify-start items-stretch">
                        <x-proficiency label="Behat" pct="60"/>
                        <x-proficiency label="PHPUnit" pct="70"/>
                        <x-proficiency label="Cypress.io" pct="60"/>
                    </div>
                </div>
                <div class="mb-6">
                    <h6 class="text-responsive font-semibold mb-1">Front End</h6>
                    <div class="flex flex-col justify-start items-stretch">
                        <x-proficiency label="Javascript" pct="70"/>
                        <x-proficiency label="VueJS" pct="80"/>
                        <x-proficiency label="Tailwind" pct="75"/>
                        <x-proficiency label="Bootstrap" pct="60"/>
                        <x-proficiency label="Laravel Mix" pct="70"/>
                        <x-proficiency label="Sass" pct="50"/>
                    </div>
                </div>
                <div class="mb-8">
                    <h6 class="text-responsive font-semibold mb-1">CI/CD</h6>
                    <div class="flex flex-col justify-start items-stretch">
                        <x-proficiency label="Docker" pct="65"/>
                        <x-proficiency label="Jenkins" pct="65"/>
                        <x-proficiency label="Phing" pct="60"/>
                        <x-proficiency label="Forge" pct="65"/>
                        <x-proficiency label="Envoyer" pct="85"/>
                        <x-proficiency label="AWS" pct="40"/>
                        <x-proficiency label="nginx" pct="50"/>
                    </div>
                </div>
            </div>
            <div class="mb-8">
                <h6 class="text-responsive font-semibold mb-3">Tooling</h6>
                <div class="flex flex-wrap justify-between">
                    <span class="badge bg-blue-200">Ubuntu</span>
                    <span class="badge bg-blue-200">Nano</span>
                    <span class="badge bg-blue-200">VS Code</span>
                    <span class="badge bg-blue-200">Git</span>
                    <span class="badge bg-blue-200">Tinkerwell</span>
                    <span class="badge bg-blue-200">Mailgun</span>
                    <span class="badge bg-blue-200">Mailhog</span>
                    <span class="badge bg-blue-200">Docker</span>
                    <span class="badge bg-blue-200">Slack</span>
                    <span class="badge bg-blue-200">TablePlus</span>
                    <span class="badge bg-blue-200">Jira</span>
                    <span class="badge bg-blue-200">BitBucket</span>
                    <span class="badge bg-blue-200">GitHub</span>
                    <span class="badge bg-blue-200">zsh</span>
                    <span class="badge bg-blue-200">Confluence</span>
                </div>
            </div>
            <div class="mb-6">
                <h6 class="mb-2 text-responsive font-semibold">Profiles</h6>
                <div class="mb-6">
                    <a class="font-semibold" href="https://stackoverflow.com/users/1978311/kurt-friars">Stack Overflow</a>
                    <a href="https://stackoverflow.com/users/1978311/kurt-friars?theme=clean"><img src="https://stackoverflow.com/users/flair/1978311.png?theme=clean" width="208" height="58" alt="profile for Kurt Friars at Stack Overflow, Q&amp;A for professional and enthusiast programmers" title="profile for Kurt Friars at Stack Overflow, Q&amp;A for professional and enthusiast programmers"></a>
                </div>
                <div class="mb-6">
                    <a class="font-semibold" href="https://github.com/kfriars">GitHub</a>
                        <div class="github-card" data-github="kfriars" data-width="220" data-height="220" data-theme="default"></div>
                </div>
            </div>
            <div class="mb-6">
                <cv-download></cv-download>
            </div>
        </div>
    </div>
@endsection

@section('end-script')
    <script src="//cdn.jsdelivr.net/github-cards/latest/widget.js"></script>
@endsection