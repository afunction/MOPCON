<template>
  <div id="notice" class="logo-bg pb-20 pt-8">
    <section class="container mx-auto flex flex-col items-center mb-6 top overflow-x-hidden">
      <div class="w-full flex justify-end">
        <a class="switch-btn" href="/2020/notice"><small>中文</small></a>
      </div>
      <div class="logo logo-speaker-title" />
      <div class="relative h-full top">
        <h2 class="relative mt-10 mb-12 md:text-3xl text-2xl text-white text-center z-10">
          <div class="logo logo-circles logo-circles-l" />Safety Measures and Guidelines
          <br> at MOPCON 2020 <span class="md:inline-block block"> during the COVID-19 Pandemic</span>
          <div class="logo logo-circles logo-circles-r" />
        </h2>
      </div>
      <p class="text-white">
        In light of the COVID-19 Pandemic, the following measures and instructions are provided for reference during MOPCON 2020, in accordance with the Guidelines for Large-Scale Public Gatherings in the wake of the COVID-19 Outbreak as issued by the Central Epidemic Command Center (CECC):
      </p>
    </section>
    <section class="container mx-auto notice-content">
      <div class="header-width">
        <ol class="list-decimal pl-6">
          <li>
            MOPCON 2020 adopts contact-information-based measures. Upon entry, participants are required to submit
            <a class="text-yellow-500" href="https://docs.google.com/forms/d/1ukO8EBA9cTWToWsISWzVjkYGyel7naUv7YAhafJqKDY/viewform?edit_requested=true" target="_blank">
              a health declaration form
            </a>. Once tested, participants will receive an identification badge and will thus be allowed to participate in the events. (According to Article 62 of the Communicable Disease Control Act, participants who submit false information will incur a fine of 500,000 NTD maximum.)
          </li>
          <li>All participants must wear masks throughout the course of the event, with the exception of specific circumstances, e.g. eating, drinking, taking medicine etc.</li>
          <li>
            The number of attendees for each venue will be restricted. Please follow the instructions from our staff members, and do not enter venues that have reached maximum capacity.
          </li>
          <li>
            Hand sanitizers and soap will be provided at the event. Please sanitize your hands when entering the venue.
          </li>
          <li>
            Participants with forehead temperature above 37.5 ℃ will be instructed to a separate area, and may either re-enter the venue after a second test results show a normal temperature, or seek medical treatment and refund their tickets with the assistance of our staff. Participants who show clear respiratory symptoms or fever upon the moment of entry will be denied entry and will not be refunded.
          </li>
          <li>
            Participants are required to monitor their own personal health. Should there be any symptoms of fever, respiratory tract infection, or diarrhea during the event, please report to our staff members immediately.
          </li>
          <li>
            If you are currently experiencing discomfort, or at high risk of contracting COVID-19 (e.g. currently in quarantine, self-isolation, aged above 65 or diagnosed with chronic disease), you are advised to avoid attending the event.
          </li>
          <li>All information and guidelines will be updated and modified in accordance with the government’s actions in regards to the epidemic situation.</li>
        </ol>
        <h3 class="notice-title">
          \\ Our Staff Members will:
        </h3>
        <ol class="list-decimal pl-6">
          <li>
            Sanitize and disinfect the venues before and after the event.
          </li>
          <li>Ensure that all participants (staff and speakers included) have their temperature taken and wear masks.</li>
          <li>Take the attendance of each participant.</li>
          <li>
            Provide hand sanitizers and soap in the venue.
          </li>
        </ol>
        <h3 class="notice-title">
          \\ Personal Data Collection Declaration:
        </h3>
        <p>
          Listed in the following are information concerning the collection of personal data involved in our contact-based safety measures:
        </p>
        <ol class="list-decimal pl-6">
          <li>
            Entity to collect personal data: MOPCON
          </li>
          <li>
            Purpose of collection: epidemic prevention, listed under the category “No.012 Public Health and Communicable Disease Control” in The Specific Purposes and the Classification of Personal Information of the Personal Information Protection Act, and will not be used for other purposes.
          </li>
          <li>
            Types of personal data to be collected: Name, contact information (phone number, corresponding address, or email address).
          </li>
          <li>
            Time period of using personal data: 28 days starting from day of collection.
          </li>
          <li>
            Entities to use personal data, and ways of using personal data: Under the Communicable Disease Control Act, the collected personal data may be provided to health authorities when required in the investigation of the epidemic situation.
          </li>
          <li>Data subjects’ rights: Under the Personal Data Protection Act, data subjects may exercise the following rights regarding their personal information: request for perusal, copy, amendments or modifications, collection or personal usage, and deletion.</li>
          <li>
            Data subjects will be denied access if refusing to provide personal data.
          </li>
        </ol>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Notice',
  data () {
    return {}
  },
  mounted () {},
  methods: {}
}
</script>
<style lang="scss" scoped>
@import "~@/assets/styles/_mix";
.container {
  @screen md {
    @apply px-32;
  }
  @screen lg {
    @apply px-48;
  }
}
.top h2 {
  @screen md {
    @include border-primary;
  }
}
.notice-title {
  @apply text-xl text-yellow-500 mt-6;
}
.notice-content {
  @apply text-white;
  li, p {
    @apply my-2;
  }
}
.switch-btn {
  @apply text-yellow-500 p-1 px-2 border border-yellow-500 rounded-lg;
  &:hover {
    @apply bg-yellow-500 text-blue-950;
  }
}
</style>
