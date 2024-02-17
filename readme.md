# Comparing performance of different json streaming parsers for PHP

This repository contains a simple benchmark to compare the performance of different JSON streaming parsers for PHP.

Results:

```text
json_decode:
memory peak: 1.234375 kB
clock time sec: 0.20915102958679
CPU time ms: 125 ms

JsonParser:
memory peak: 3724.5859375 kB
clock time sec: 11.772974967957
CPU time ms: 5203.125 ms

json-machine:
memory peak: 214.3359375 kB
clock time sec: 2.2307989597321
CPU time ms: 859.375 ms

jsonstreamingparser:
memory peak: 78.609375 kB
clock time sec: 6.5879240036011
CPU time ms: 3046.875 ms

```
