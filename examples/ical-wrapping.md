# Using LineWrap filter for iCal wrapping

``` twig
{% set dateFormat = 'Ymd\THis' %}{% set output %}
BEGIN:VCALENDAR
METHOD:PUBLISH
VERSION:2.0
PRODID:-//Organisation Name//Software Name//EN
X-WR-CALNAME:My important calendar
CALSCALE:GREGORIAN
BEGIN:VTIMEZONE
TZID:Europe/London
TZURL:http://tzurl.org/zoneinfo-outlook/Europe/London
X-LIC-LOCATION:Europe/London
BEGIN:DAYLIGHT
TZOFFSETFROM:+0000
TZOFFSETTO:+0100
TZNAME:BST
DTSTART:19700329T010000
RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:+0100
TZOFFSETTO:+0000
TZNAME:GMT
DTSTART:19701025T020000
RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU
END:STANDARD
END:VTIMEZONE
{% for event in events %}
BEGIN:VEVENT
SUMMARY:{{ event.name }}
DESCRIPTION:{{ event.description | replace("\n": '\n') }}
UID:ROTA{{ event.id }}@{# add site root url here #}
ORGANIZER;CN="{{ site.settings.owner }}":MAILTO:{{ site.settings.adminemail }}
STATUS:CONFIRMED
DTSTAMP:{{ event.created | date(dateFormat) }}Z
DTSTART;TZID=Europe/London:{{ event.date | date(dateFormat) }}
DTEND;TZID=Europe/London:{{ event.end | date(dateFormat) }}
LAST-MODIFIED:{{ event.updated | date(dateFormat) }}Z
LOCATION:{{ event.location.name }}, {{ event.location.address }}
URL:{# add site root url here #}{{ path_for('event', {'id': event.id }) }}
BEGIN:VALARM
ACTION:DISPLAY
DESCRIPTION:Reminder for {{ event.name }}
TRIGGER:-P1D
END:VALARM
END:VEVENT
{% endfor %}
END:VCALENDAR
{% endset %}
{{ output | linewrap(73, "\n ") | raw }}{# Max length 75 chars, (after line break and spaces) #}
```