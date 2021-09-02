<template>
    <div class="static">
        <div class="fixed h-full w-full bg-black bg-opacity-75 top-0 bottom-0 z-10"
             v-bind:class="[isActive ? 'block opacity-100 z-10' : 'hidden opacity-0 z-[-1]']"></div>
        <div class="lg:mt-[-180px]"
             v-bind:class="[isActive ? 'z-20 relative' : 'z-[10] relative']">
            <svg viewBox="0 0 1415 1301" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" class="w-full h-auto z-[-1]">
                <defs>
                    <rect id="path-1" x="10" y="10" width="69" height="158" rx="12"></rect>
                    <filter x="-30.4%" y="-13.3%" width="160.9%" height="126.6%" filterUnits="objectBoundingBox"
                            id="filter-2">
                        <feMorphology radius="1" operator="dilate" in="SourceAlpha"
                                      result="shadowSpreadOuter1"></feMorphology>
                        <feOffset dx="0" dy="0" in="shadowSpreadOuter1" result="shadowOffsetOuter1"></feOffset>
                        <feGaussianBlur stdDeviation="6" in="shadowOffsetOuter1"
                                        result="shadowBlurOuter1"></feGaussianBlur>
                        <feColorMatrix values="0 0 0 0 0.976470588   0 0 0 0 1   0 0 0 0 0  0 0 0 0.347406988 0"
                                       type="matrix" in="shadowBlurOuter1"></feColorMatrix>
                    </filter>
                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="linearGradient-3">
                        <stop stop-color="#000000" stop-opacity="0.5" offset="0%"></stop>
                        <stop stop-color="#FAFAFA" stop-opacity="0.5" offset="56.8485661%"></stop>
                        <stop stop-color="#FFFFFF" stop-opacity="0.5" offset="100%"></stop>
                    </linearGradient>

                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="linearGradient-4">
                        <stop stop-color="#FFFFFF" stop-opacity="0.5" offset="0%"></stop>
                        <stop stop-color="#FAFAFA" stop-opacity="0.5" offset="56.8485661%"></stop>
                        <stop stop-color="#FFFFFF" stop-opacity="0.7" offset="100%"></stop>
                    </linearGradient>
                    <rect id="path-4" x="10" y="32" width="69" height="136" rx="12"></rect>
                    <rect id="path-5" x="10" y="10" width="69" height="136" rx="12"></rect>
                </defs>
                <g id="Artboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="steckdosenleiste" transform="translate(-175.000000, 0.000000)">
                        <g id="dose" transform="translate(0.000000, 532.000000)">
                            <path
                                d="M536.70807,0 L1591.70807,0 L1591.70807,0 L1591.70807,295 L536.70807,295 C492.52529,295 456.70807,259.18278 456.70807,215 L456.70807,80 C456.70807,35.81722 492.52529,8.11624501e-15 536.70807,0 Z"
                                id="leiste" fill="#121212" v-bind:class="[isActive ? 'opacity-75' : 'opacity-100']"></path>
                            <path
                                d="M496.747607,173.208657 C431.827919,155.523671 361.893275,149.112863 319.433519,186.418709 C240.14478,256.088079 333.066748,411.078031 269.369219,569.554452 C225.513612,678.670814 125.479753,744.477909 36.4295339,785.112322"
                                id="kabel-schwarz" stroke="#121212" stroke-width="20"
                                transform="translate(266.588570, 472.112322) rotate(-7.000000) translate(-266.588570, -472.112322) "
                                v-bind:class="[isActive ? 'opacity-75' : 'opacity-100']"></path>
                            <path
                                d="M1158.20807,56.5 C1205.77021,56.5 1244.80998,92.9885918 1248.86123,139.499626 L1248.20807,139.5 C1244.42262,139.5 1241.33897,142.504783 1241.21213,146.25935 L1241.20807,146.5 L1241.20807,148.5 C1241.20807,152.285452 1244.21285,155.369099 1247.96742,155.495941 L1248.20807,155.5 L1248.86114,155.501374 C1244.80942,202.011932 1205.76987,238.5 1158.20807,238.5 C1110.64628,238.5 1071.60672,202.011932 1067.555,155.501374 L1068.20807,155.5 C1071.99352,155.5 1075.07717,152.495217 1075.20401,148.74065 L1075.20807,148.5 L1075.20807,146.5 C1075.20807,142.714548 1072.20329,139.630901 1068.44872,139.504059 L1068.20807,139.5 L1067.55491,139.499626 C1071.60616,92.9885918 1110.64593,56.5 1158.20807,56.5 Z M1128.20807,132.5 C1119.9238,132.5 1113.20807,139.215729 1113.20807,147.5 C1113.20807,155.784271 1119.9238,162.5 1128.20807,162.5 C1136.49234,162.5 1143.20807,155.784271 1143.20807,147.5 C1143.20807,139.215729 1136.49234,132.5 1128.20807,132.5 Z M1188.20807,132.5 C1179.9238,132.5 1173.20807,139.215729 1173.20807,147.5 C1173.20807,155.784271 1179.9238,162.5 1188.20807,162.5 C1196.49234,162.5 1203.20807,155.784271 1203.20807,147.5 C1203.20807,139.215729 1196.49234,132.5 1188.20807,132.5 Z"
                                id="dunkle-dose" fill="#EBEBEB" opacity="0.04"></path>
                            <path
                                d="M938.20807,56.5 C985.770207,56.5 1024.80998,92.9885918 1028.86123,139.499626 L1028.20807,139.5 C1024.42262,139.5 1021.33897,142.504783 1021.21213,146.25935 L1021.20807,146.5 L1021.20807,148.5 C1021.20807,152.285452 1024.21285,155.369099 1027.96742,155.495941 L1028.20807,155.5 L1028.86114,155.501374 C1024.80942,202.011932 985.769866,238.5 938.20807,238.5 C890.646275,238.5 851.606725,202.011932 847.554999,155.501374 L848.20807,155.5 C851.993522,155.5 855.077169,152.495217 855.204011,148.74065 L855.20807,148.5 L855.20807,146.5 C855.20807,142.714548 852.203287,139.630901 848.44872,139.504059 L848.20807,139.5 L847.554912,139.499626 C851.606165,92.9885918 890.645934,56.5 938.20807,56.5 Z M908.20807,132.5 C899.923799,132.5 893.20807,139.215729 893.20807,147.5 C893.20807,155.784271 899.923799,162.5 908.20807,162.5 C916.492342,162.5 923.20807,155.784271 923.20807,147.5 C923.20807,139.215729 916.492342,132.5 908.20807,132.5 Z M968.20807,132.5 C959.923799,132.5 953.20807,139.215729 953.20807,147.5 C953.20807,155.784271 959.923799,162.5 968.20807,162.5 C976.492342,162.5 983.20807,155.784271 983.20807,147.5 C983.20807,139.215729 976.492342,132.5 968.20807,132.5 Z"
                                id="dunkle-dose" fill="#EBEBEB" opacity="0.04"></path>
                        </g>
                        <g id="kabel-rechts-1" transform="translate(1279.187493, 187.931337)" v-bind:class="[isActive ? 'text-black' : 'text-primary']">
                            <path
                                class="stroke-current"
                                d="M416.504036,-11.7087857 C373.066107,-24.7323935 326.272657,-29.4534513 297.862726,-1.9806159 C244.810428,49.3254216 306.984754,163.463389 264.364575,280.168869 C235.020676,360.524528 168.087765,408.986303 108.504036,438.910367"
                                id="Stroke-1" stroke-width="20"
                                transform="translate(262.504036, 208.410367) scale(-1, 1) rotate(285.000000) translate(-262.504036, -208.410367) "></path>
                            <path
                                class="fill-current"
                                d="M120.520577,377.068663 C170.778489,377.068663 211.520577,417.81075 211.520577,468.068663 C211.520577,518.326575 170.778489,559.068663 120.520577,559.068663 C80.0324927,559.068663 45.720191,532.626995 33.9099942,496.069981 L-1.47942297,496.068663 C-10.315979,496.068663 -17.479423,488.905219 -17.479423,480.068663 L-17.479423,456.068663 C-17.479423,447.232107 -10.315979,440.068663 -1.47942297,440.068663 L33.909671,440.068345 C45.7195651,403.510813 80.0321235,377.068663 120.520577,377.068663 Z"
                                id="Combined-Shape"
                                transform="translate(97.020577, 468.068663) rotate(90.000000) translate(-97.020577, -468.068663) "></path>
                        </g>
                        <g transform="translate(1499.208070, 587.500000)" v-bind:class="[isActive ? 'text-black' : 'text-primary']">
                            <path
                                d="M114.5,23.5 C164.757912,23.5 205.5,64.2420878 205.5,114.5 C205.5,164.757912 164.757912,205.5 114.5,205.5 C74.0119157,205.5 39.6996139,179.058332 27.8894171,142.501318 L-7.5,142.5 C-16.336556,142.5 -23.5,135.336556 -23.5,126.5 L-23.5,102.5 C-23.5,93.663444 -16.336556,86.5 -7.5,86.5 L27.889094,86.499682 C39.698988,49.9421504 74.0115464,23.5 114.5,23.5 Z"
                                class="fill-current"
                                transform="translate(91.000000, 114.500000) rotate(-90.000000) translate(-91.000000, -114.500000) "></path>
                            <path
                                d="M626.35792,250.970797 C546.815738,236.082638 461.129032,230.68568 409.105651,262.09172 C311.957936,320.74309 425.809625,451.221852 347.764881,584.635707 C294.031248,676.495648 171.465788,731.895551 62.35792,766.103755"
                                class="stroke-current"
                                stroke-width="20"
                                transform="translate(344.357920, 502.603755) rotate(-90.000000) translate(-344.357920, -502.603755) "></path>
                        </g>
                        <g id="kabel-links" transform="translate(124.208070, 0.000000)" v-bind:class="[isActive ? 'text-black' : 'text-primary']">
                            <path
                                d="M614,541.5 C622.836556,541.5 630,548.663444 630,557.5 L630.001318,592.889417 C666.558332,604.699614 693,639.011916 693,679.5 C693,729.757912 652.257912,770.5 602,770.5 C551.742088,770.5 511,729.757912 511,679.5 C511,639.011546 537.44215,604.698988 573.999682,592.889094 L574,557.5 C574,548.663444 581.163444,541.5 590,541.5 L614,541.5 Z"
                                class="fill-current"></path>
                            <path
                                d="M603.325929,15.0417639 C538.406241,-2.64322189 468.471597,-9.05402922 426.011841,28.2518166 C346.723102,97.9211864 404.2521,208.349509 340.554571,366.825929 C296.698964,475.942291 88.1047902,562.691516 -0.945429182,603.325929"
                                class="stroke-current" stroke-width="20"
                                transform="translate(301.190250, 302.135679) rotate(-270.000000) translate(-301.190250, -302.135679) "></path>
                        </g>
                        <a class="toggle-button z-20 relative" @click="toggle()">
                            <g transform="translate(514.708070, 593.000000)">
                                <rect class="toggle-button-outer" fill="#F9FF00" opacity="0.200000003" x="0" y="0" width="89"
                                      height="178" rx="15"></rect>
                                <g id="Toggle-Bottom" v-bind:class="[isActive ? 'hidden' : 'block']">
                                    <use fill="black" fill-opacity="1" filter="url(#filter-2)"
                                         xlink:href="#path-1"></use>
                                    <use fill="#F9FF00" fill-rule="evenodd" xlink:href="#path-1"></use>
                                </g>
                                <g id="Toggle-Bottom-toggled" v-bind:class="[isActive ? 'block' : 'hidden']">
                                    <use fill="black" fill-opacity="1" filter="url(#filter-2)"
                                         xlink:href="#path-1"></use>
                                    <use fill="#BFC300" fill-rule="evenodd" xlink:href="#path-1"></use>
                                </g>
                                <g id="Toggle-Top" v-bind:class="[isActive ? 'hidden' : 'block']">
                                    <use fill="#F9FF00" xlink:href="#path-4"></use>
                                    <use fill-opacity="0.3" fill="url(#linearGradient-3)" xlink:href="#path-4"></use>
                                </g>
                                <g id="Toggle-Top-toggled" v-bind:class="[isActive ? 'block' : 'hidden']">
                                    <use fill="#F9FF00" xlink:href="#path-5"></use>
                                    <use fill-opacity="1.0" fill="url(#linearGradient-4)" xlink:href="#path-5"></use>
                                </g>
                            </g>
                        </a>
                    </g>
                </g>
            </svg>
        </div>


    </div>
</template>

<script>
export default {
    data() {
        return {
            isActive: false
        }
    },
    methods: {
        toggle: function() {
            this.isActive = !this.isActive;
            // some code to filter users
        }
    }
}
</script>

<style scoped>
.toggle-button .toggle-button-outer {
    opacity: 0.2;
}
.toggle-button:hover{
    @apply cursor-pointer;
}
.toggle-button:hover .toggle-button-outer {
    opacity: 0.4;
    @apply cursor-pointer;
}
</style>
