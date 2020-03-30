@component('mail::message')

#Thank you for your message!
#Here is your message information: 
<p><strong>Name </strong>{{$data['name']}}</p>
<p><strong>Email </strong>{{$data['email']}}</p>

<strong>Message: </strong>

{{$data['message']}}

#We have received your message and will be in touch with you soon!

@endcomponent
