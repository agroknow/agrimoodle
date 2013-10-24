****************************************************************
* Thu Aug 23 13:19:09 CET 2012
* Tasos Koutoumanos - anastasios.koutoumanos@gmail.com
* Agro-Know Technologies - http://www.agroknow.gr
****************************************************************

This plugin is part of agriMoodle.
For more information please visit: http://agrimoodle.agroknow.gr

The plugin provides and OAI-PMH target for your Moodle instance. OAI-PMH stands
for the Open Archives Initiative Protocol for Metadata Harvesting. You can find
more information here: http://www.openarchives.org/OAI/openarchivesprotocol.html

A harvester is a client application that issues OAI-PMH requests. A harvester
is operated by a service provider as a means of collecting metadata from
repositories. In that sense, your Moodle installation becomes a "repository"
from which any associated harvester can request information related to the
metadata of the courses and the resources available through your installation.

Other important concepts, as they are used by OAI-PMH are:
* resource - A resource is the object or "stuff" that metadata is "about".
* item - An item is a constituent of a repository from which metadata about
    a resource can be disseminated. That metadata may be disseminated
    on-the-fly from the associated resource, cross-walked from some
    canonical form, actually stored in the repository, etc.
* record - A record is metadata in a specific metadata format. A record is
    returned as an XML-encoded byte stream in response to a protocol request
    to disseminate a specific metadata format from a constituent item.
* (unique) identifier - Each item has an identifier that is unique within the
    scope of the repository of which it is a constituent. Note that Items may
    contain metadata in multiple formats. The unique identifier maps to the
    item, and all possible records available from a single item share the same
    unique identifier.

The plugin implements the full set of the 6 verbs as they are described in the
last version of the OAI-PMH specification (version 2.0, released Jun 14, 2002).

{see also:
 http://wiki.agroknow.gr/organic_edunet/index.php/OAI-PMH_targets and
 http://ariadne.cs.kuleuven.be/lomi/index.php/Setting_Up_OAI-PMH#Getting_Started
}
For harvesting purposes, the Service Provider will usually invoke the ListRecords
verb (with a metadata prefix and usually a datespan) on the Metadata Provider.

1. GetRecord
------------
This verb is used to retrieve an individual metadata record from a repository.

http://arXiv.org/oai2?
       verb=GetRecord&identifier=oai:arXiv.org:cs/0112017&metadataPrefix=oai_dc

2. Identify
-----------
This verb is used to retrieve information about a repository.

http://memory.loc.gov/cgi-bin/oai?verb=Identify


3. ListIdentifiers
------------------
This verb is an abbreviated form of ListRecords, retrieving only headers rather
than records.

http://an.oa.org/OAI-script?verb=ListIdentifiers&resumptionToken=xxx45abttyz


4. ListMetadataFormats
----------------------
This verb is used to retrieve the metadata formats available from a repository.

http://www.perseus.tufts.edu/cgi-bin/pdataprov?
       verb=ListMetadataFormats&identifier=oai:www.t.edu:Per:text:1999.02.0119


5. ListRecords
--------------
This verb is used to harvest records from a repository.

http://an.oa.org/OAI-script?
       verb=ListRecords&from=1998-01-15&set=physics:hep&metadataPrefix=oai_rfc1807


6. ListSets
-----------
This verb is used to retrieve the set structure of a repository.

http://an.oa.org/OAI-script?verb=ListSets




INSTALLATION
============
To install you will have to perform the following steps:

	1.
	2.
	3.	Login in your Moodle platform as Administrator and
		click on OAI Target inside Site Administration block.

At this point the block initialization should be performed and the block
should be available in the Blocks list. Note that the block is available
only inside courses.

Settings:
---------

Bugs:
-----
If you find a bug please submit it here:
FIXME: provide a url for the issue tracker

Please provide the bug description and don't forget Moodle and block version.
