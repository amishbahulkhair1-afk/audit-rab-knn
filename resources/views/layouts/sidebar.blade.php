<div>

    @php
        $activeClass = 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/20';
        $normalClass = 'text-slate-300 hover:bg-slate-800 hover:text-white';
    @endphp

    {{-- MOBILE OVERLAY --}}
    <div v-if="sidebarOpen" @click="closeSidebar" class="
fixed
inset-0
bg-black/50
z-40
lg:hidden
">
    </div>





    {{-- SIDEBAR --}}
    <aside
        :class="[
            sidebarMini ?
            'lg:w-20' :
            'lg:w-72',
        
            sidebarOpen ?
            'translate-x-0' :
            '-translate-x-full lg:translate-x-0'
        
        ]"
        class="

fixed

top-0

left-0

h-screen

w-64

bg-slate-900

z-50

transition-all
duration-300

flex
flex-col

">


        {{-- HEADER SIDEBAR --}}

        <div class="
relative

h-20

flex

items-center

px-6

border-b
border-slate-700

">


            {{-- LOGO --}}
            <div class="flex items-center gap-3">


                <div
                    class="
                w-11
                h-11

                shrink-0

                rounded-xl

                bg-emerald-500

                flex
                items-center
                justify-center

                font-bold
                text-xl

                text-white
            ">

                    A

                </div>



                {{-- TEXT LOGO --}}
                <div v-show="!sidebarMini"
                    class="
                transition-all
                duration-300
                overflow-hidden
                whitespace-nowrap
            ">

                    <h1
                        class="
                    font-bold
                    text-lg
                    text-white
                ">

                        LateeBuildIt

                    </h1>


                    <p class="
                    text-xs
                    text-slate-400
                ">

                        Sistem Audit Bangunan

                    </p>


                </div>


            </div>




            {{-- BUTTON COLLAPSE DESKTOP --}}
            <button @click="toggleMini"
                class="
hidden
lg:flex

absolute

right-2

translate-x-1/2

top-16

w-8
h-8

items-center
justify-center

rounded-full

bg-slate-800

border
border-slate-700

text-slate-300

hover:bg-emerald-500
hover:text-white

transition-all
duration-300

shadow-lg

z-50

">


                <svg class="
w-4
h-4

transition-transform
duration-300

"
                    :class="sidebarMini
                        ?
                        'rotate-180' :
                        ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">


                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />


                </svg>


            </button>


        </div>


        {{-- MENU AREA --}}
        <nav class="
        flex-1
        overflow-y-auto
        sidebar-scroll
        p-4
        space-y-2
    ">

            <a href="{{ route('dashboard') }}"
                class="
flex items-center gap-3 px-4 py-3 rounded-xl transition
{{ request()->routeIs('dashboard') ? $activeClass : $normalClass }}
">

                <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25">
                    </path>
                </svg>

                <span v-show="!sidebarMini">
                    Dashboard
                </span>

            </a>





            <a href="{{ route('buildings.index') }}"
                class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('buildings.*') ? $activeClass : $normalClass }}

">


                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="M3 21h18M5 21V5l7-3 7 3v16M9 9h6M9 13h6" />

                </svg>


                <span v-show="!sidebarMini">
                    Data Bangunan
                </span>


            </a>





            <a href="{{ route('audits.index') }}"
                class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('audits.*') ? $activeClass : $normalClass }}

">


                <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12">
                    </path>
                </svg>


                <span v-show="!sidebarMini">
                    Audit Bangunan
                </span>


            </a>





            <a href="{{ route('rabs.index') }}"
                class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('rabs.*') ? $activeClass : $normalClass }}

">


                <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z">
                    </path>
                </svg>


                <span v-show="!sidebarMini">
                    RAB
                </span>


            </a>





            @if (auth()->user()->role == 'admin')
                <div class="pt-6">


                    <p v-show="!sidebarMini"
                        class="
px-4 mb-3
text-xs
font-semibold
uppercase
tracking-wider
text-slate-500
">
                        Master Data
                    </p>



                    <a href="{{ route('materials.index') }}"
                        class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('materials.*') ? $activeClass : $normalClass }}
">


                        <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12">
                            </path>
                        </svg>


                        <span v-show="!sidebarMini">
                            Material
                        </span>


                    </a>




                    <a href="{{ route('labors.index') }}"
                        class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('labors.*') ? $activeClass : $normalClass }}
">

                        <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.867 19.125h.008v.008h-.008v-.008Z"></path>
                        </svg>


                        <span v-show="!sidebarMini">
                            Tenaga Kerja
                        </span>

                    </a>




                    <a href="{{ route('equipments.index') }}"
                        class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('equipments.*') ? $activeClass : $normalClass }}
">

                        <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z">
                            </path>
                        </svg>


                        <span v-show="!sidebarMini">
                            Peralatan
                        </span>

                    </a>




                    <a href="{{ route('support-costs.index') }}"
                        class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('support-costs.*') ? $activeClass : $normalClass }}
">

                        <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                            </path>
                        </svg>


                        <span v-show="!sidebarMini">
                            Biaya Pendukung
                        </span>

                    </a>




                    <a href="{{ route('ahsps.index') }}"
                        class="
flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->routeIs('ahsps.*') ? $activeClass : $normalClass }}
">

                        <svg class="h-5 w-5" data-slot="icon" fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z">
                            </path>
                        </svg>


                        <span v-show="!sidebarMini">
                            AHSP
                        </span>


                    </a>


                </div>
            @endif


        </nav>

        {{-- USER DROPDOWN --}}

        <div class="
mt-auto

border-t
border-slate-700

p-4

">


            <div class="
relative
">


                {{-- BUTTON USER --}}

                <button @click="userMenu = !userMenu"
                    class="

w-full

flex
items-center
gap-3

p-2

rounded-xl

hover:bg-slate-800

transition

">


                    {{-- Avatar --}}

                    <div
                        class="
w-10
h-10

rounded-full

bg-emerald-500

flex
items-center
justify-center

text-white
font-bold

shrink-0

">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>



                    {{-- Nama User --}}

                    <div v-show="!sidebarMini" class="
text-left
overflow-hidden
">

                        <p class="
text-sm
font-semibold
text-white
truncate
">

                            {{ auth()->user()->name }}

                        </p>


                        <p class="
text-xs
text-slate-400
capitalize
">

                            {{ auth()->user()->role }}

                        </p>


                    </div>


                </button>



                {{-- DROPDOWN --}}

                <div v-show="userMenu" @click.outside="userMenu=false"
                    class="

absolute

bottom-20

left-4

right-4


bg-slate-800

border
border-slate-700

rounded-xl

shadow-xl

overflow-hidden

">


                    <a href="{{ route('profile.edit') }}"
                        class="

flex
items-center
gap-3

px-4
py-3

text-sm

text-slate-200

hover:bg-slate-700

">


                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0" />

                        </svg>


                        Profil


                    </a>



                    <form method="POST" action="{{ route('logout') }}">

                        @csrf


                        <button type="submit"
                            class="

w-full

flex
items-center
gap-3

px-4
py-3

text-sm

text-red-400

hover:bg-red-500/10

">


                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7" />

                            </svg>


                            Logout


                        </button>


                    </form>


                </div>


            </div>


        </div>

    </aside>



</div>
