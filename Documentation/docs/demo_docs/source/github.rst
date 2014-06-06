.. This is a comment. Note how any initial comments are moved by
   transforms to after the document title, subtitle, and docinfo.


=====
Pages
=====

.. meta::
   :keywords: github, pull, merge, commit, sync
   :description lang=en: Tells how to use github with git shell.

.. contents:: Table of Contents
.. section-numbering::

Creating a new repository
=========================

	Go to git shell and navigate to where you want to put the repository. (cd c:\your\path\here\)
	Type: git init

Download repository from github
===============================

	Go to git shell and navigate to the parent directory of where you want to download the repository to. (cd c:\your\path\here\)
	Go to the parent directory of where you want to download the repository to.
	Type: git clone http://your/github/url/here

Sync local repository to remote
===============================

	Go to git shell and navigate to your local repository. (cd c:\your\path\here\)
	Type: git commit -a
	You will be prompted to type a summary for your change.
	After typing the summary save the file and close it.
	Type: git push origin master

Sync remote repository with local
=================================

	Go to git shell and navigate to your local repository. (cd c:\your\path\here\)
	Type: git pull

When to use
===========

	When creating a new repository to upload to github use *Create a new Repository*

	When the repository has already been created by someone else and you want to use it use *Download repository from github*

	After making a change to a file or folder you will use *Sync local repository to remote*. Try to do this after every change so your able to track changes more accurately.

	After someone else makes a change and commits it you can get that change by using *Sync remote repository wih local*.

	For more information see https://www.atlassian.com/git/tutorial