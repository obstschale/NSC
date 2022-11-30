# -*- coding: utf-8 -*-

import copy
import random
import alp.core as core
import json


class Item(object):
    def __init__(self, **kwargs):
        self.title = kwargs.pop("title", "")
        self.subtitle = kwargs.pop("subtitle", "")
        self.uid = kwargs.pop("uid", "{0}.{1}".format(core.bundle(), random.getrandbits(40)))
        if "valid" in kwargs.keys():
            if kwargs["valid"] == True:
                self.valid = "yes"
            elif kwargs["valid"] == False:
                self.valid = "no"
            else:
                self.valid = kwargs["valid"]
            kwargs.pop("valid")
        else:
            self.valid = None
        self.autocomplete = kwargs.pop("autocomplete", None)
        self.icon = kwargs.pop("icon", "icon.png")
        self.fileIcon = kwargs.pop("fileIcon", False)
        self.fileType = kwargs.pop("fileType", False)
        self.arg = kwargs.pop("arg", None)
        self.type = kwargs.pop("type", None)

    def copy(self):
        return copy.copy(self)

    def get(self):
        content = {
            "title": self.title,
            "subtitle": self.subtitle,
            "icon": self.icon,
            "fileIcon": self.fileIcon,
            "fileType": self.fileType
        }
        attrib = {
            "uid": self.uid,
            "valid": self.valid,
        }
        if self.autocomplete:
            attrib["autocomplete"] = self.autocomplete
        if self.arg:
            attrib["arg"] = self.arg
        if self.type:
            attrib["type"] = self.type

        data = {"attrib": attrib, "content": content}

        return data

def feedback(items):
    
    def processItem(item):
        json_item = {}

        data = item.get()

        for (k, v) in data["attrib"].items():
            if v is None:
                continue
            json_item[k] = v

        for (k, v) in data["content"].items():
            if v is None:
                continue
            if k != "fileIcon" and k != "fileType":
                json_item[k] = v
            if k == "icon":
                icon_item = {}
                if "fileIcon" in data["content"].keys():
                    if data["content"]["fileIcon"] == True:
                        icon_item["type"] = "fileicon"
                if "fileType" in data["content"].keys():
                    if data["content"]["fileType"] == True:
                        icon_item["type"] = "filetype"
        return json_item

    final_items = {}
    items_array = []
    if isinstance(items, list):
        for anItem in items:
            final_item = processItem(anItem)
            items_array.append(final_item)
    else:
        final_item = processItem(items)
        items_array.append(final_item)

    final_items["items"] = items_array

    print(json.dumps(final_items))
