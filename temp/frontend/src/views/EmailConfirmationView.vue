<template>
  <section class="h-screen flex justify-center items-center flex-col">
    <img
      src="@/assets/books/email_verify.svg"
      alt="Email Verification Picture"
    />
    <section class="email-text w-1/3">
      <div class="text-header text-center mb-2">Email Verification Sent</div>
      <p>
        We have sent an email verification to user@example.com click the link in
        the email to verify.
      </p>
      <p>The email will expire in 24 hours.</p>
      <form @submit.prevent method="post" class="mt-2">
        If the email did not send. Click
        <input
          type="submit"
          name="resend"
          value="here"
          class="underline hover:text-gray-500 hover:no-underline cursor-pointer"
        />
        to send another verification email
      </form>
    </section>
  </section>
</template>

<script>
export default {
  name: "EmailConfirmationView",
};
</script>
